<?php

namespace App\Observers;

use App\Models\Showcase;
use Illuminate\Support\Facades\Artisan;

class ShowcaseObserver
{
    /**
     * Handle the Showcase "created" event.
     *
     * @param  \App\Models\Showcase  $showcase
     * @return void
     */
    public function created(Showcase $showcase)
    {
        Artisan::call("sitemap:generate");
    }

    /**
     * Handle the Showcase "updated" event.
     *
     * @param  \App\Models\Showcase  $showcase
     * @return void
     */
    public function updated(Showcase $showcase)
    {
        Artisan::call("sitemap:generate");
    }

    /**
     * Handle the Showcase "deleted" event.
     *
     * @param  \App\Models\Showcase  $showcase
     * @return void
     */
    public function deleted(Showcase $showcase)
    {
        Artisan::call("sitemap:generate");
    }

    /**
     * Handle the Showcase "restored" event.
     *
     * @param  \App\Models\Showcase  $showcase
     * @return void
     */
    public function restored(Showcase $showcase)
    {
        Artisan::call("sitemap:generate");
    }

    /**
     * Handle the Showcase "force deleted" event.
     *
     * @param  \App\Models\Showcase  $showcase
     * @return void
     */
    public function forceDeleted(Showcase $showcase)
    {
        Artisan::call("sitemap:generate");
    }
}
