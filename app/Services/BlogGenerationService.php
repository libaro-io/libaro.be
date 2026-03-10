<?php

namespace App\Services;

use App\Filament\FilamentBlockType;
use App\Models\Blog;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use OpenAI\Laravel\Facades\OpenAI;
use RuntimeException;
use Throwable;

class BlogGenerationService
{
    /**
     * Generate a draft blog post using a three-step AI pipeline:
     * 1. Research — web-search model finds a current topic and returns a structured brief
     * 2. Writing — standard model writes structured JSON blog post from the brief
     * 3. Image — DALL-E generates a hero image
     *
     * Returns null if research found nothing relevant for the selected category.
     *
     * @throws RuntimeException on OpenAI or validation failure
     */
    public function generate(?string $forceCategory = null): ?Blog
    {
        $selected = $this->selectCategory($forceCategory);
        $categoryKey = $selected['key'];
        $categoryConfig = $selected['config'];

        Log::info('[BlogGeneration] Category selected.', ['category' => $categoryKey]);

        $researchBrief = $this->research($categoryKey, $categoryConfig);

        if ($researchBrief === null) {
            Log::info('[BlogGeneration] Research returned nothing relevant — skipping.', ['category' => $categoryKey]);

            return null;
        }

        Log::info('[BlogGeneration] Research brief received.', [
            'category' => $categoryKey,
            'topic' => $researchBrief['topic'] ?? 'unknown',
        ]);

        $parsed = $this->write($researchBrief, $categoryConfig);

        Log::info('[BlogGeneration] Writing complete.', [
            'title' => $parsed['title'],
            'block_count' => count($parsed['blocks']),
        ]);

        $slug = $this->ensureUniqueSlug($parsed['slug']);

        $imagePath = null;
        $imagePrompt = $parsed['image_prompt'] ?? null;
        if ($imagePrompt !== null && $imagePrompt !== '') {
            $imagePath = $this->generateAndStoreImage($imagePrompt, $slug);
            Log::info('[BlogGeneration] Image generation ' . ($imagePath !== null ? 'succeeded' : 'skipped') . '.', [
                'slug' => $slug,
            ]);
        }

        return DB::transaction(function () use ($parsed, $slug, $imagePath, $categoryKey) {
            $blog = Blog::query()->create([
                'visible' => false,
                'pin_on_homepage' => false,
                'title' => $parsed['title'],
                'slug' => $slug,
                'description' => $parsed['description'],
                'image' => $imagePath,
                'author' => 'Libaro',
                'publish_date' => now()->toDateString(),
                'link' => null,
                'topic_category' => $categoryKey,
            ]);

            $this->syncTags($blog, $parsed['tags']);

            $imageTextIndex = 0;
            $sort = 0;
            foreach ($parsed['blocks'] as $block) {
                $type = $block['type'];
                $content = $block['content'];

                if ($type === FilamentBlockType::ImageText->value) {
                    $this->logImageMetadata($content, $sort);
                    $content = $this->stripImageMetadata($content);
                    $content['layout'] = $imageTextIndex % 2 === 0 ? 'image_text' : 'text_image';
                    $imageTextIndex++;
                }

                if ($imagePath !== null && in_array($type, [
                    FilamentBlockType::Image->value,
                    FilamentBlockType::ImageText->value,
                    FilamentBlockType::LogoText->value,
                ], true) && empty($content['image'])) {
                    $content['image'] = $imagePath;
                }

                $blog->blocks()->create([
                    'type' => $type,
                    'content' => $content,
                    'sort' => $sort++,
                ]);
            }

            Log::info('[BlogGeneration] Draft blog post persisted.', [
                'id' => $blog->id,
                'slug' => $blog->slug,
                'title' => $blog->title,
            ]);

            return $blog;
        });
    }

    /**
     * Run the research + writing pipeline without persisting. Returns the raw output for review.
     *
     * @return array{research: ?array<string, mixed>, generated: ?array<string, mixed>, category: string}
     */
    public function dryRun(?string $forceCategory = null): array
    {
        $selected = $this->selectCategory($forceCategory);
        $categoryKey = $selected['key'];
        $categoryConfig = $selected['config'];

        $researchBrief = $this->research($categoryKey, $categoryConfig);

        if ($researchBrief === null) {
            return ['research' => null, 'generated' => null, 'category' => $categoryKey];
        }

        $parsed = $this->write($researchBrief, $categoryConfig);

        return ['research' => $researchBrief, 'generated' => $parsed, 'category' => $categoryKey];
    }

    /**
     * Select a topic category, rotating through least-recently-used.
     *
     * @return array{key: string, config: array<string, mixed>}
     */
    private function selectCategory(?string $forceCategory = null): array
    {
        /** @var array<string, array<string, mixed>> $categories */
        $categories = config('blog-generation.topic_categories', []);

        if ($categories === []) {
            throw new RuntimeException('No topic categories configured.');
        }

        if ($forceCategory !== null) {
            if (! isset($categories[$forceCategory])) {
                throw new RuntimeException("Unknown category: {$forceCategory}");
            }

            return ['key' => $forceCategory, 'config' => $categories[$forceCategory]];
        }

        $recentCategories = Blog::query()
            ->whereNotNull('topic_category')
            ->orderByDesc('created_at')
            ->limit(20)
            ->pluck('topic_category')
            ->all();

        $allKeys = array_keys($categories);

        // Find categories never used
        $neverUsed = array_diff($allKeys, $recentCategories);
        if ($neverUsed !== []) {
            $picked = $neverUsed[array_rand($neverUsed)];

            return ['key' => $picked, 'config' => $categories[$picked]];
        }

        // Pick the one that appears latest (least recently) in the recent list
        $leastRecent = null;
        $leastRecentIndex = -1;
        foreach ($allKeys as $key) {
            $index = array_search($key, $recentCategories, true);
            if ($index !== false && ($leastRecent === null || $index > $leastRecentIndex)) {
                $leastRecent = $key;
                $leastRecentIndex = $index;
            }
        }

        $picked = $leastRecent ?? $allKeys[array_rand($allKeys)];

        return ['key' => $picked, 'config' => $categories[$picked]];
    }

    /**
     * Step 1: Use the web-search model to find a current topic and return a structured brief.
     *
     * @param  array<string, mixed>  $categoryConfig
     * @return array<string, mixed>|null The research brief, or null if nothing relevant found.
     */
    private function research(string $categoryKey, array $categoryConfig): ?array
    {
        $language = config('blog-generation.language', 'Dutch');
        $today = now()->toDateString();
        $label = (string) ($categoryConfig['label'] ?? $categoryKey);
        $description = (string) ($categoryConfig['description'] ?? '');

        $systemPrompt = config('blog-generation.research_prompt', '');
        $systemPrompt = str_replace(
            ['{{ language }}', '{{ today }}', '{{ category_label }}', '{{ category_description }}'],
            [$language, $today, $label, $description],
            $systemPrompt,
        );

        $userMessage = config('blog-generation.research_user_message', '');
        $userMessage = str_replace(
            ['{{ category_label }}', '{{ category_description }}'],
            [$label, $description],
            $userMessage,
        );

        try {
            $response = OpenAI::chat()->create([
                'model' => config('blog-generation.research_model', 'gpt-4o-search-preview'),
                'messages' => [
                    ['role' => 'system', 'content' => $systemPrompt],
                    ['role' => 'user', 'content' => $userMessage],
                ],
                'max_tokens' => config('blog-generation.research_max_tokens', 3500),
            ]);
        } catch (Throwable $e) {
            throw new RuntimeException('Research step failed: ' . $e->getMessage(), 0, $e);
        }

        $content = $response->choices[0]->message->content ?? null;

        if ($content === null || $content === '') {
            throw new RuntimeException('Research step returned empty content.');
        }

        $parsed = $this->extractJson($content);

        if ($parsed === null) {
            throw new RuntimeException('Research step returned no valid JSON.');
        }

        $status = $parsed['status'] ?? null;
        if ($status === 'nothing_relevant') {
            return null;
        }

        $this->validateResearchBrief($parsed);

        return $parsed;
    }

    /**
     * Step 2: Use a standard model with JSON response format to write the blog post from the research brief.
     *
     * @param  array<string, mixed>  $researchBrief
     * @param  array<string, mixed>  $categoryConfig
     * @return array{title: string, slug: string, description: string, tags: list<string>, image_prompt: string|null, blocks: list<array{type: string, content: array<string, mixed>}>}
     */
    private function write(array $researchBrief, array $categoryConfig): array
    {
        $language = config('blog-generation.language', 'Dutch');
        $locale = config('blog-generation.locale', 'nl');

        $ctaServiceKey = (string) ($categoryConfig['cta_service'] ?? 'web-development');
        /** @var array<string, array<string, string>> $ctaServices */
        $ctaServices = config('blog-generation.cta_services', []);
        $ctaConfig = $ctaServices[$ctaServiceKey] ?? $ctaServices['web-development'] ?? [
            'url_path' => 'expertise/web-development',
            'title' => 'Op zoek naar een digitale partner?',
            'button_text' => 'Bekijk onze aanpak',
        ];

        $ctaUrl = 'https://libaro.be/' . $locale . '/' . ($ctaConfig['url_path'] ?? 'contact');
        $ctaTitle = $ctaConfig['title'] ?? 'Op zoek naar een digitale partner?';
        $ctaButtonText = $ctaConfig['button_text'] ?? 'Neem contact op';

        $availableTags = Tag::all()
            ->map(fn (Tag $tag): string => $tag->name['nl'] ?? $tag->name['en'] ?? '')
            ->filter(fn (string $name): bool => $name !== '')
            ->values()
            ->implode(', ');

        $prompt = config('blog-generation.writing_prompt', '');
        $prompt = str_replace(
            ['{{ language }}', '{{ cta_url }}', '{{ cta_service_title }}', '{{ cta_button_text }}', '{{ available_tags }}'],
            [$language, $ctaUrl, $ctaTitle, $ctaButtonText, $availableTags],
            $prompt,
        );

        try {
            $response = OpenAI::chat()->create([
                'model' => config('blog-generation.writing_model', 'gpt-4o'),
                'messages' => [
                    ['role' => 'system', 'content' => $prompt],
                    ['role' => 'user', 'content' => json_encode($researchBrief, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR)],
                ],
                'max_tokens' => config('blog-generation.writing_max_tokens', 4000),
                'temperature' => config('blog-generation.writing_temperature', 0.65),
                'top_p' => config('blog-generation.writing_top_p', 0.9),
                'response_format' => ['type' => 'json_object'],
            ]);
        } catch (Throwable $e) {
            throw new RuntimeException('Writing step failed: ' . $e->getMessage(), 0, $e);
        }

        $content = $response->choices[0]->message->content ?? null;

        if ($content === null || $content === '') {
            throw new RuntimeException('Writing step returned empty content.');
        }

        $parsed = json_decode($content, true);

        if (! is_array($parsed) || ! isset($parsed['title'])) {
            throw new RuntimeException('Writing step returned invalid or incomplete JSON.');
        }

        $title = (string) $parsed['title'];
        $slug = isset($parsed['slug']) && is_string($parsed['slug']) ? $parsed['slug'] : Str::slug($title);
        $description = isset($parsed['description']) && is_string($parsed['description']) ? $parsed['description'] : '';
        $tags = is_array($parsed['tags'] ?? null) ? array_values(array_map('strval', $parsed['tags'])) : [];
        $blocks = $this->normalizeBlocks($parsed);

        $this->validateGeneratedStructure($blocks);

        $imagePrompt = isset($parsed['image_prompt']) && is_string($parsed['image_prompt']) ? $parsed['image_prompt'] : null;

        return [
            'title' => $title,
            'slug' => $slug,
            'description' => $description,
            'tags' => $tags,
            'image_prompt' => $imagePrompt,
            'blocks' => $blocks,
        ];
    }

    /**
     * Sync tags from the model's output to the blog, selecting only from existing DB tags.
     *
     * @param  list<string>  $tagNames
     */
    private function syncTags(Blog $blog, array $tagNames): void
    {
        $availableTags = Tag::all();

        $tagIds = collect($tagNames)
            ->map(function (string $tagName) use ($availableTags): ?int {
                $match = $availableTags->first(function (Tag $tag) use ($tagName): bool {
                    $nlName = $tag->name['nl'] ?? '';

                    return mb_strtolower($nlName) === mb_strtolower(trim($tagName));
                });

                return $match?->id;
            })
            ->filter()
            ->take(4)
            ->values()
            ->all();

        if (count($tagIds) < 2) {
            Log::warning('[BlogGeneration] Fewer than 2 tags matched from DB.', [
                'requested' => $tagNames,
                'matched_count' => count($tagIds),
            ]);
        }

        $blog->tags()->sync($tagIds);
    }

    /**
     * @param  array<string, mixed>  $brief
     */
    private function validateResearchBrief(array $brief): void
    {
        $requiredKeys = ['topic', 'angle', 'why_it_matters', 'key_facts', 'suggested_title'];

        foreach ($requiredKeys as $key) {
            if (! isset($brief[$key]) || (is_string($brief[$key]) && trim($brief[$key]) === '')) {
                throw new RuntimeException("Research brief missing or empty required key: {$key}");
            }
        }

        if (! is_array($brief['key_facts']) || $brief['key_facts'] === []) {
            throw new RuntimeException('Research brief key_facts must be a non-empty array.');
        }
    }

    /**
     * @param  list<array{type: string, content: array<string, mixed>}>  $blocks
     */
    private function validateGeneratedStructure(array $blocks): void
    {
        if ($blocks === []) {
            throw new RuntimeException('Writing step returned no usable blocks.');
        }

        $firstType = $blocks[0]['type'];
        if ($firstType !== FilamentBlockType::Text->value) {
            throw new RuntimeException("First block must be type 'text', got '{$firstType}'.");
        }

        $lastType = $blocks[count($blocks) - 1]['type'];
        if ($lastType !== FilamentBlockType::CtaBlock->value) {
            throw new RuntimeException("Last block must be type 'ctablock', got '{$lastType}'.");
        }

        $hasImageText = false;
        foreach ($blocks as $block) {
            if ($block['type'] === FilamentBlockType::ImageText->value) {
                $hasImageText = true;
                break;
            }
        }
        if (! $hasImageText) {
            throw new RuntimeException('Blog must contain at least one image_text block.');
        }

        $blockCount = count($blocks);
        if ($blockCount < 4 || $blockCount > 7) {
            Log::warning('[BlogGeneration] Block count outside expected range 4-7.', ['count' => $blockCount]);
        }

        $lastBlock = $blocks[count($blocks) - 1];
        $ctaUrl = $lastBlock['content']['button_url'] ?? '';
        if (is_string($ctaUrl) && ! str_starts_with($ctaUrl, 'https://libaro.be/')) {
            Log::warning('[BlogGeneration] CTA button_url does not start with https://libaro.be/.', ['url' => $ctaUrl]);
        }
    }

    /**
     * @param  array<string, mixed>  $parsed
     * @return list<array{type: string, content: array<string, mixed>}>
     */
    private function normalizeBlocks(array $parsed): array
    {
        $allowedTypes = [
            FilamentBlockType::Text->value,
            FilamentBlockType::NumberText->value,
            FilamentBlockType::CtaBlock->value,
            FilamentBlockType::Image->value,
            FilamentBlockType::ImageText->value,
            FilamentBlockType::LogoText->value,
        ];
        $normalized = [];

        if (isset($parsed['blocks']) && is_array($parsed['blocks'])) {
            foreach ($parsed['blocks'] as $block) {
                if (! is_array($block)) {
                    continue;
                }
                $type = isset($block['type']) && is_string($block['type']) ? $block['type'] : FilamentBlockType::Text->value;
                if (! in_array($type, $allowedTypes, true)) {
                    continue;
                }
                $content = isset($block['content']) && is_array($block['content']) ? $block['content'] : [];
                $normalized[] = [
                    'type' => $type,
                    'content' => $this->normalizeBlockContent($type, $content),
                ];
            }
        }

        if ($normalized === []) {
            throw new RuntimeException('Writing step returned no usable blocks.');
        }

        return $normalized;
    }

    /**
     * @param  array<string, mixed>  $content
     * @return array<string, mixed>
     */
    private function normalizeBlockContent(string $type, array $content): array
    {
        return match ($type) {
            FilamentBlockType::NumberText->value => [
                'number' => min(9, max(1, isset($content['number']) ? (int) $content['number'] : 1)),
                'title' => (string) ($content['title'] ?? ''),
                'text' => (string) ($content['text'] ?? ''),
            ],
            FilamentBlockType::CtaBlock->value => [
                'title' => (string) ($content['title'] ?? ''),
                'text' => (string) ($content['text'] ?? ''),
                'button_text' => (string) ($content['button_text'] ?? 'Contacteer ons'),
                'button_url' => (string) ($content['button_url'] ?? $this->defaultCtaUrl()),
            ],
            FilamentBlockType::Image->value => [
                'image' => (string) ($content['image'] ?? ''),
            ],
            FilamentBlockType::ImageText->value => [
                'image' => (string) ($content['image'] ?? ''),
                'text' => (string) ($content['text'] ?? ''),
                'layout' => ($content['layout'] ?? 'image_text') === 'text_image' ? 'text_image' : 'image_text',
                // image_search_query and image_alt are kept temporarily — stripped during persistence
                'image_search_query' => (string) ($content['image_search_query'] ?? ''),
                'image_alt' => (string) ($content['image_alt'] ?? ''),
            ],
            FilamentBlockType::LogoText->value => [
                'image' => (string) ($content['image'] ?? ''),
                'text' => (string) ($content['text'] ?? ''),
            ],
            default => [
                'text' => (string) ($content['text'] ?? ''),
            ],
        };
    }

    /**
     * Log image metadata from an image_text block so the human reviewer can find suitable images.
     *
     * @param  array<string, mixed>  $content
     */
    private function logImageMetadata(array $content, int $blockSort): void
    {
        $query = $content['image_search_query'] ?? '';
        $alt = $content['image_alt'] ?? '';

        if ($query !== '' || $alt !== '') {
            Log::info('[BlogGeneration] Image metadata for block.', [
                'block_sort' => $blockSort,
                'image_search_query' => $query,
                'image_alt' => $alt,
            ]);
        }
    }

    /**
     * Strip image metadata fields that are not part of the Filament block schema.
     *
     * @param  array<string, mixed>  $content
     * @return array<string, mixed>
     */
    private function stripImageMetadata(array $content): array
    {
        unset($content['image_search_query'], $content['image_alt']);

        return $content;
    }

    /**
     * Step 3: Generate a hero image with DALL-E and upload to S3.
     */
    private function generateAndStoreImage(string $prompt, string $slug): ?string
    {
        try {
            $response = OpenAI::images()->create([
                'model' => config('blog-generation.image_model', 'dall-e-3'),
                'prompt' => $prompt,
                'n' => 1,
                'size' => '1792x1024',
                'quality' => 'hd',
            ]);
        } catch (Throwable $e) {
            return null;
        }

        $url = $response->data[0]->url ?? null;
        if ($url === null) {
            return null;
        }

        try {
            $download = Http::timeout(30)->get($url);
            if (! $download->successful()) {
                return null;
            }
            $imageData = $download->body();
        } catch (Throwable $e) {
            return null;
        }

        if ($imageData === '') {
            return null;
        }

        $webp = $this->convertToWebp($imageData, 1000);
        if ($webp !== null) {
            $path = 'blogs/' . Str::slug($slug) . '-' . Str::random(8) . '.webp';
            if (Storage::disk('s3')->put($path, $webp, 'public')) {
                return $path;
            }
        }

        $path = 'blogs/' . Str::slug($slug) . '-' . Str::random(8) . '.png';

        return Storage::disk('s3')->put($path, $imageData, 'public') ? $path : null;
    }

    /**
     * @param  int<1, max>  $targetHeight
     */
    private function convertToWebp(string $imageData, int $targetHeight, int $quality = 85): ?string
    {
        if (! function_exists('imagecreatefromstring') || ! function_exists('imagewebp')) {
            return null;
        }

        $source = @imagecreatefromstring($imageData);
        if ($source === false) {
            return null;
        }

        $origW = imagesx($source);
        $origH = imagesy($source);
        $newW = max(1, (int) round($origW * ($targetHeight / max(1, $origH))));

        $resized = imagecreatetruecolor($newW, $targetHeight);
        if ($resized === false) {
            imagedestroy($source);

            return null;
        }

        imagecopyresampled($resized, $source, 0, 0, 0, 0, $newW, $targetHeight, $origW, $origH);
        imagedestroy($source);

        ob_start();
        imagewebp($resized, null, $quality);
        $result = ob_get_clean();
        imagedestroy($resized);

        return is_string($result) && $result !== '' ? $result : null;
    }

    /**
     * Extract a JSON object from a string that may contain surrounding prose or markdown fences.
     *
     * @return array<string, mixed>|null
     */
    private function extractJson(string $text): ?array
    {
        // Try direct parse first
        $decoded = json_decode($text, true);
        if (is_array($decoded)) {
            return $decoded;
        }

        // Strip markdown code fences if present
        if (preg_match('/```(?:json)?\s*\n?(.*?)\n?```/s', $text, $matches)) {
            $decoded = json_decode($matches[1], true);
            if (is_array($decoded)) {
                return $decoded;
            }
        }

        // Find the first { ... } block (outermost braces)
        $start = strpos($text, '{');
        $end = strrpos($text, '}');
        if ($start !== false && $end !== false && $end > $start) {
            $decoded = json_decode(substr($text, $start, $end - $start + 1), true);
            if (is_array($decoded)) {
                return $decoded;
            }
        }

        return null;
    }

    private function defaultCtaUrl(): string
    {
        $locale = config('blog-generation.locale', 'nl');

        return 'https://libaro.be/' . $locale . '/contact';
    }

    private function ensureUniqueSlug(string $slug): string
    {
        $base = $slug;
        $candidate = $base;
        $n = 0;

        while (Blog::query()->where('slug', $candidate)->exists()) {
            $candidate = $base . '-' . now()->format('Y-\WW') . ($n > 0 ? '-' . $n : '');
            $n++;
        }

        return $candidate;
    }
}
