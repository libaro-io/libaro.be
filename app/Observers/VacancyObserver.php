<?php

namespace App\Observers;

use App\Models\Vacancy;
use Illuminate\Support\Facades\Artisan;

class VacancyObserver
{
    /**
     * Handle the Vacancy "created" event.
     *
     * @param  \App\Models\Vacancy  $vacancy
     * @return void
     */
    public function created(Vacancy $vacancy)
    {
        Artisan::call("sitemap:generate");
    }

    /**
     * Handle the Vacancy "updated" event.
     *
     * @param  \App\Models\Vacancy  $vacancy
     * @return void
     */
    public function updated(Vacancy $vacancy)
    {
        Artisan::call("sitemap:generate");
    }

    /**
     * Handle the Vacancy "deleted" event.
     *
     * @param  \App\Models\Vacancy  $vacancy
     * @return void
     */
    public function deleted(Vacancy $vacancy)
    {
        Artisan::call("sitemap:generate");
    }

    /**
     * Handle the Vacancy "restored" event.
     *
     * @param  \App\Models\Vacancy  $vacancy
     * @return void
     */
    public function restored(Vacancy $vacancy)
    {
        Artisan::call("sitemap:generate");
    }

    /**
     * Handle the Vacancy "force deleted" event.
     *
     * @param  \App\Models\Vacancy  $vacancy
     * @return void
     */
    public function forceDeleted(Vacancy $vacancy)
    {
        Artisan::call("sitemap:generate");
    }
}
