<?php

namespace App\Services;

use App\Filament\FilamentBlockType;
use App\Models\Blog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use OpenAI\Laravel\Facades\OpenAI;
use RuntimeException;
use Throwable;

class BlogGenerationService
{
    /**
     * Generate a draft blog post using a three-step AI pipeline:
     * 1. Research — web-search model finds a current topic
     * 2. Writing — standard model writes structured JSON blog post
     * 3. Image — DALL-E generates a hero image based on the writing step's prompt
     *
     * @throws RuntimeException on OpenAI or validation failure
     */
    public function generate(): Blog
    {
        $research = $this->research();
        $parsed = $this->write($research);

        $slug = $this->ensureUniqueSlug($parsed['slug']);
        $tagsString = implode(',', array_map('trim', $parsed['tags']));

        $imagePath = null;
        $imagePrompt = $parsed['image_prompt'] ?? null;
        if ($imagePrompt !== null && $imagePrompt !== '') {
            $imagePath = $this->generateAndStoreImage($imagePrompt, $slug);
        }

        return DB::transaction(function () use ($parsed, $slug, $tagsString, $imagePath) {
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
                'tags' => $tagsString,
            ]);

            $sort = 0;
            foreach ($parsed['blocks'] as $block) {
                $type = $block['type'];
                $content = $block['content'];
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

            return $blog;
        });
    }

    /**
     * Step 1: Use the web-search model to find a current topic and gather research.
     */
    private function research(): string
    {
        $language = config('blog-generation.language', 'Dutch');
        $prompt = config('blog-generation.research_prompt', '');
        $prompt = str_replace('{{ language }}', $language, $prompt);
        $prompt = str_replace('{{ today }}', now()->toDateString(), $prompt);

        try {
            $response = OpenAI::chat()->create([
                'model' => config('blog-generation.research_model', 'gpt-4o-search-preview'),
                'messages' => [
                    ['role' => 'system', 'content' => $prompt],
                    ['role' => 'user', 'content' => 'Find one current topic about custom software, integrations, or general development (not AI). Show source dates and write a detailed research summary.'],
                ],
                'max_tokens' => config('blog-generation.research_max_tokens', 1800),
            ]);
        } catch (Throwable $e) {
            throw new RuntimeException('Research step failed: ' . $e->getMessage(), 0, $e);
        }

        $content = $response->choices[0]->message->content ?? null;

        if ($content === null || $content === '') {
            throw new RuntimeException('Research step returned empty content.');
        }

        return $content;
    }

    /**
     * Step 2: Use a standard model with JSON response format to write the blog post.
     *
     * @return array{title: string, slug: string, description: string, tags: array<string>, image_prompt: string|null, blocks: array<int, array{type: string, content: array<string, mixed>}>}
     */
    private function write(string $research): array
    {
        $language = config('blog-generation.language', 'Dutch');
        $prompt = config('blog-generation.writing_prompt', '');
        $prompt = str_replace('{{ language }}', $language, $prompt);

        try {
            $response = OpenAI::chat()->create([
                'model' => config('blog-generation.writing_model', 'gpt-4o'),
                'messages' => [
                    ['role' => 'system', 'content' => $prompt],
                    ['role' => 'user', 'content' => "Here are the research notes:\n\n" . $research],
                ],
                'max_tokens' => config('blog-generation.writing_max_tokens', 2500),
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
        $tags = is_array($parsed['tags'] ?? null) ? array_map('strval', $parsed['tags']) : [];
        $blocks = $this->normalizeBlocks($parsed);

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
     * @param  array<string, mixed>  $parsed
     * @return array<int, array{type: string, content: array<string, mixed>}>
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
     * Step 3: Generate a hero image with DALL-E and upload to S3.
     * Uses WebP conversion when available, otherwise stores original format.
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
     * Resize image data to a target height and convert to WebP.
     * Returns the WebP binary string, or null if GD/WebP is unavailable.
     */
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
