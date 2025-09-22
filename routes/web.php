<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UpdateLangController;
use Illuminate\Support\Facades\Route;



Route::prefix('{locale?}')->group(function () {
    Route::get('/', HomeController::class);
    Route::get('/contact', ContactController::class);
    Route::post('lang', UpdateLangController::class);
});
