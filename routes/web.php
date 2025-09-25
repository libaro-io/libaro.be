<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\AssetsController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ClientRandomProjectController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CookiePolicyController;
use App\Http\Controllers\DetailBlogController;
use App\Http\Controllers\DetailProductController;
use App\Http\Controllers\DetailProjectController;
use App\Http\Controllers\IntegrationTimecardController;
use App\Http\Controllers\PrivacyPolicyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupportTimecardController;
use App\Http\Controllers\TermsController;
use App\Http\Controllers\SubmitContactFormController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UpdateLangController;
use App\Http\Controllers\Expertises\AiIntegrationsExpertiseController;
use App\Http\Controllers\Expertises\AppsExpertiseController;
use App\Http\Controllers\Expertises\WebDevelopmentExpertiseController;
use App\Http\Controllers\ProjectController;

Route::prefix('{locale?}')->group(function () {
    Route::get('/', HomeController::class);
    Route::post('lang', UpdateLangController::class);

    Route::get('/contact', ContactController::class);
    Route::post('/contact', SubmitContactFormController::class);

    Route::get('over-ons', AboutUsController::class);

    Route::get('/realisaties', ProjectController::class);
    Route::get('/realisaties/{project:slug}', DetailProjectController::class);

    Route::get('/blog', BlogController::class);
    Route::get('/blog/{blog:slug}', DetailBlogController::class);

    Route::get('/producten', ProductController::class);
    Route::get('/producten/{product:slug}', DetailProductController::class);

    Route::get('/privacy', PrivacyPolicyController::class);
    Route::get('/cookies', CookiePolicyController::class);
    Route::get('/terms', TermsController::class);

    Route::get('expertise/web-development', WebDevelopmentExpertiseController::class);
    Route::get('expertise/apps', AppsExpertiseController::class);
    Route::get('expertise/ai-integrations', AiIntegrationsExpertiseController::class);

    Route::get('/clients/{client}', ClientRandomProjectController::class);

    Route::get('/assets', AssetsController::class);

    Route::get('/timecard/integration', IntegrationTimecardController::class);
    Route::get('/timecard/support', SupportTimecardController::class);
});
