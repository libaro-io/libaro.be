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
use App\Http\Controllers\Expertises\AiIntegrationsExpertiseController;
use App\Http\Controllers\Expertises\AppsExpertiseController;
use App\Http\Controllers\Expertises\IOTExpertiseController;
use App\Http\Controllers\Expertises\OdooExpertiseController;
use App\Http\Controllers\Expertises\RobawsExpertiseController;
use App\Http\Controllers\Expertises\WebDevelopmentExpertiseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IntegrationTimecardController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\PrivacyPolicyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SubmitContactFormController;
use App\Http\Controllers\SupportTimecardController;
use App\Http\Controllers\TermsController;
use App\Http\Controllers\UpdateLangController;
use Illuminate\Support\Facades\Route;
use Spatie\ResponseCache\Middlewares\CacheResponse;

// Don't forget to add new routes to the sitemap.blade.php!

Route::prefix('{locale?}')->group(function () {
    Route::post('lang', UpdateLangController::class);

    Route::get('/', HomeController::class)->middleware(CacheResponse::class);
    Route::get('l/{landingPage:slug}', LandingPageController::class)->middleware(CacheResponse::class);

    Route::get('contact', ContactController::class)->middleware(CacheResponse::class);
    Route::post('contact', SubmitContactFormController::class);

    Route::get('over-ons', AboutUsController::class)->middleware(CacheResponse::class);

    Route::get('realisaties', ProjectController::class)->middleware(CacheResponse::class);
    Route::get('realisaties/{project:slug}', DetailProjectController::class)->middleware(CacheResponse::class);

    Route::get('blog', BlogController::class)->middleware(CacheResponse::class);
    Route::get('blog/{blog:slug}', DetailBlogController::class)->middleware(CacheResponse::class);

    Route::get('producten', ProductController::class)->middleware(CacheResponse::class);
    Route::get('producten/{product:slug}', DetailProductController::class)->middleware(CacheResponse::class);

    Route::get('privacy', PrivacyPolicyController::class)->middleware(CacheResponse::class);
    Route::get('cookies', CookiePolicyController::class)->middleware(CacheResponse::class);
    Route::get('terms', TermsController::class)->middleware(CacheResponse::class);

    Route::get('expertise/web-development', WebDevelopmentExpertiseController::class)->middleware(CacheResponse::class);
    Route::get('expertise/apps', AppsExpertiseController::class)->middleware(CacheResponse::class);
    Route::get('expertise/ai-integrations', AiIntegrationsExpertiseController::class)->middleware(CacheResponse::class);
    Route::get('expertise/iot', IOTExpertiseController::class)->middleware(CacheResponse::class);
    Route::get('expertise/odoo', OdooExpertiseController::class)->middleware(CacheResponse::class);
    Route::get('expertise/robaws', RobawsExpertiseController::class)->middleware(CacheResponse::class);

    Route::get('clients/{client}', ClientRandomProjectController::class)->middleware(CacheResponse::class);

    Route::get('assets', AssetsController::class)->middleware(CacheResponse::class);

    Route::get('timecard/integration', IntegrationTimecardController::class)->middleware(CacheResponse::class);
    Route::get('timecard/support', SupportTimecardController::class)->middleware(CacheResponse::class);
});
