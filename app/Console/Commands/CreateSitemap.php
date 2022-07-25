<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator;

class CreateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate {url?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawl the site and create a new sitemap';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $url = $this->argument('url');

        SitemapGenerator::create($url ?? config('app.url'))->writeToFile(public_path('sitemap.xml'));
        return 0;
    }
}
