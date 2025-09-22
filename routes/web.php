<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CookiePolicyController;
use App\Http\Controllers\DetailProjectController;
use App\Http\Controllers\PrivacyPolicyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TermsController;
use App\Http\Controllers\SubmitContactFormController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UpdateLangController;
use App\Http\Controllers\ProjectController;


Route::prefix('{locale?}')->group(function () {
    Route::get('/', HomeController::class);
    Route::get('/contact', ContactController::class);
    Route::post('/contact', SubmitContactFormController::class);
    Route::post('lang', UpdateLangController::class);

    Route::get('/realisaties', ProjectController::class);
    Route::get('/realisaties/{project:slug}', DetailProjectController::class);
    Route::get('/blog', BlogController::class);
    Route::get('/producten', ProductController::class);

    Route::get('/privacy', PrivacyPolicyController::class);
    Route::get('/cookies', CookiePolicyController::class);
    Route::get('/terms', TermsController::class);
});
