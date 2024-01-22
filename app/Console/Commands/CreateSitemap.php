<?php

namespace App\Console\Commands;

use App\Models\LandingPage;
use App\Models\Showcase;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;

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
        $showcases = Showcase::query()->where('visible','=',1)->get();
        SitemapGenerator::create($url ?? config('app.url'))
            ->hasCrawled(function (Url $url) {
                $segment2 = $url->segment(2);
                $fullUrl = Str::of($url->url);
                $urlWithFilter = $fullUrl->contains('?filter=');
                if ($segment2 === 'docs') {
                    return;
                } elseif ($segment2 === 'blog' && $urlWithFilter) {
                    $url->setPriority(0.1);
                } elseif ($segment2 === 'realisaties' && $urlWithFilter) {
                    $url->setPriority(0.1);
                }
                return $url;
            })
            ->getSitemap()
            ->add($showcases)
            ->add(LandingPage::all())
            ->writeToFile(public_path('sitemap.xml'));

        return 0;
    }
}
