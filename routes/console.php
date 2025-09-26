<?php

use App\Console\Commands\createSitemap;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command(createSitemap::class)
    ->daily()
    ->onOneServer()
    ->withoutOverlapping()
    ->runInBackground();
