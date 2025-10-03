<?php

use App\Console\Commands\CreateSitemap;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Spatie\ResponseCache\Commands\ClearCommand;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command(CreateSitemap::class)
    ->daily()
    ->onOneServer()
    ->withoutOverlapping()
    ->runInBackground();

Schedule::command(ClearCommand::class)
    ->daily()
    ->onOneServer()
    ->withoutOverlapping()
    ->runInBackground();
