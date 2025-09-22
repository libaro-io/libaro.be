<?php

use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UpdateLangController;
use App\Http\Controllers\ProjectController;


Route::prefix('{locale?}')->group(function () {
    Route::get('/', HomeController::class);
    Route::get('/contact', ContactController::class);
    Route::post('lang', UpdateLangController::class);

    Route::get('/realisaties', ProjectController::class);
    Route::get('/blog', BlogController::class);
});
