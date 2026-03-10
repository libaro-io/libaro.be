<?php

namespace App\Console\Commands;

use App\Services\BlogGenerationService;
use Illuminate\Console\Command;
use Throwable;

class GenerateBlogPost extends Command
{
    protected $signature = 'app:generate-blog-post
        {--category= : Force a specific topic category (e.g. web_development, ai_automation)}
        {--dry-run : Run research + writing without persisting, output JSON to console}';

    protected $description = 'Generate a draft blog post via OpenAI and save it as visible=false for review';

    public function handle(BlogGenerationService $service): int
    {
        /** @var string|null $category */
        $category = $this->option('category') ?: null;
        $dryRun = (bool) $this->option('dry-run');

        if ($dryRun) {
            return $this->handleDryRun($service, $category);
        }

        try {
            $blog = $service->generate($category);
        } catch (Throwable $e) {
            $this->error('Blog generation failed: ' . $e->getMessage());

            return self::FAILURE;
        }

        if ($blog === null) {
            $this->info('No relevant topic found for this week — skipped.');

            return self::SUCCESS;
        }

        $this->info("Draft blog post created: \"{$blog->title}\" (id: {$blog->id}, slug: {$blog->slug}).");
        $this->info('Review and publish it from the Filament admin.');

        return self::SUCCESS;
    }

    private function handleDryRun(BlogGenerationService $service, ?string $category): int
    {
        $this->info('Running in dry-run mode (no data will be persisted)...');
        $this->newLine();

        try {
            $result = $service->dryRun($category);
        } catch (Throwable $e) {
            $this->error('Dry run failed: ' . $e->getMessage());

            return self::FAILURE;
        }

        $this->info("Category: {$result['category']}");
        $this->newLine();

        if ($result['research'] === null) {
            $this->warn('Research returned nothing relevant for this category.');

            return self::SUCCESS;
        }

        $this->info('=== RESEARCH BRIEF ===');
        $this->line(json_encode($result['research'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR));
        $this->newLine();

        $this->info('=== GENERATED BLOG POST ===');
        $this->line(json_encode($result['generated'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR));

        return self::SUCCESS;
    }
}
