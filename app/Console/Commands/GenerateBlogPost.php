<?php

namespace App\Console\Commands;

use App\Services\BlogGenerationService;
use Illuminate\Console\Command;
use Throwable;

class GenerateBlogPost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-blog-post';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a draft blog post via OpenAI and save it as visible=false for review';

    public function handle(BlogGenerationService $service): int
    {
        try {
            $blog = $service->generate();
        } catch (Throwable $e) {
            $this->error('Blog generation failed: ' . $e->getMessage());

            return self::FAILURE;
        }

        $this->info("Draft blog post created: \"{$blog->title}\" (id: {$blog->id}, slug: {$blog->slug}).");
        $this->info('Review and publish it from the Filament admin.');

        return self::SUCCESS;
    }
}
