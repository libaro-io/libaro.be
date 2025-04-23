<?php

namespace App\Console\Commands;

use App\Models\LandingPage;
use App\Models\Showcase;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;
use Carbon\Carbon;

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
        $baseUrl = $url ?? config('app.url');
        $showcases = Showcase::query()->where('visible','=',1)->get();

        $sitemap = Sitemap::create();

        SitemapGenerator::create($baseUrl)
            ->configureCrawler(function ($crawler) {
                // Optional: Configure crawl depth, etc. if needed
                // $crawler->setMaximumDepth(3);
            })
            ->hasCrawled(function (Url $url) use ($baseUrl) {
                // Skip the absolute root URL if it's crawled by comparing full URLs
                if (rtrim($url->url, '/') === rtrim($baseUrl, '/')) {
                    return;
                }

                // Existing path check (can be removed now)
                // if ($url->path() === '/') {
                //    return;
                // }

                $segment1 = $url->segment(1); // Expected language code
                $segment2 = $url->segment(2); // Expected content type
                $segment3 = $url->segment(3); // Potential detail identifier

                // Skip client detail pages as they redirect
                if ($segment2 === 'clients') {
                    return;
                }

                $fullUrl = Str::of($url->url);
                $urlWithFilter = $fullUrl->contains('?filter=');

                $changeFrequency = Url::CHANGE_FREQUENCY_MONTHLY;

                if (is_null($segment2)) {
                    if (strlen($segment1 ?? '') === 2) {
                        $url->setPriority(1.0);
                        $url->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY);
                        return $url;
                    }
                }

                if ($segment2 === 'blog' && $urlWithFilter) {
                    $url->setPriority(0.1);
                    $url->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY);
                    return $url;
                }
                if ($segment2 === 'realisaties' && $urlWithFilter) {
                    $url->setPriority(0.1);
                    $url->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY);
                    return $url;
                }

                switch ($segment2) {
                    case 'services':
                        $url->setPriority(0.8);
                        $changeFrequency = Url::CHANGE_FREQUENCY_MONTHLY;
                        break;
                    case 'realisaties':
                        $url->setPriority(0.7);
                        $changeFrequency = Url::CHANGE_FREQUENCY_WEEKLY;
                        break;
                    case 'producten':
                        $url->setPriority(0.7);
                        $changeFrequency = Url::CHANGE_FREQUENCY_WEEKLY;
                        break;
                    case 'blog':
                        if ($segment3) {
                            $url->setPriority(0.5);
                            $changeFrequency = Url::CHANGE_FREQUENCY_MONTHLY;
                        } else {
                            $url->setPriority(0.6);
                            $changeFrequency = Url::CHANGE_FREQUENCY_DAILY;
                        }
                        break;
                    case 'over-ons':
                        $url->setPriority(0.4);
                        $changeFrequency = Url::CHANGE_FREQUENCY_YEARLY;
                        break;
                    case 'contact':
                        $url->setPriority(0.4);
                        $changeFrequency = Url::CHANGE_FREQUENCY_YEARLY;
                        break;
                    case 'jobs':
                        $url->setPriority(0.4);
                        $changeFrequency = Url::CHANGE_FREQUENCY_MONTHLY;
                        break;
                    case 'privacy':
                    case 'cookie':
                    case 'terms':
                        $url->setPriority(0.1);
                        $changeFrequency = Url::CHANGE_FREQUENCY_YEARLY;
                        break;
                    default:
                        break;
                }

                if ($segment2 === 'docs') {
                    return;
                }

                if (!$url->changeFrequency) {
                    $url->setChangeFrequency($changeFrequency);
                }

                return $url;
            })
            ->getSitemap($sitemap)
            ->add($showcases)
            ->add(LandingPage::all())
            ->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap generated successfully.');

        return Command::SUCCESS;
    }
}
