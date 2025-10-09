<?php

namespace App\Console\Commands;

use App\Models\Blog;
use App\Models\LandingPage;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\View;

class CreateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-sitemap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the sitemap';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $projects = Project::query()
            ->where('visible', '=', true)
            ->where('is_product', '=', false)
            ->orderByDesc('date')
            ->orderBy('id')
            ->get();

        $products = Project::query()
            ->where('visible', '=', true)
            ->where('is_product', '=', true)
            ->orderByDesc('date')
            ->orderBy('id')
            ->get();

        $blogs = Blog::query()
            ->where('visible', '=', true)
            ->orderByDesc('publish_date')
            ->get();

        $landingPages = LandingPage::query()
            ->get();

        $fs = new Filesystem;
        $pathPrefix = public_path();

        if (! $fs->exists($pathPrefix)) {
            $fs->makeDirectory($pathPrefix, 0755, true);
        }

        $lastModGeneralPages = Carbon::parse('2025-10-09');

        $output = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n" . View::make('sitemap',
            [
                'projects' => $projects,
                'products' => $products,
                'blogs' => $blogs,
                'landingPages' => $landingPages,
                'lastModGeneralPages' => $lastModGeneralPages,
            ])->render();
        $fs->put("{$pathPrefix}/sitemap.xml", $output);
    }
}
