<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\Client;
use App\Models\Showcase;
use App\Models\Vacancy;
use App\Observers\ArticleObserver;
use App\Observers\ClientObserver;
use App\Observers\ShowcaseObserver;
use App\Observers\VacancyObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Article::observe(ArticleObserver::class);
        Client::observe(ClientObserver::class);
        Showcase::observe(ShowcaseObserver::class);
        Vacancy::observe(VacancyObserver::class);
    }
}
