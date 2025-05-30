<?php

use App\Services\RoutePrefix;
use App\ValueObjects\WebRoutes;
use App\Http\Controllers\TermsPage;
use App\Http\Controllers\ContactForm;
use App\Http\Controllers\CookiesPage;
use App\Http\Controllers\PrivacyPage;
use Illuminate\Support\Facades\Route;
use Spatie\Honeypot\ProtectAgainstSpam;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AssetsController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\ShowcaseController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\ExpertiseController;
use App\Http\Controllers\VacanciesController;
use App\Http\Controllers\ClientRandomShowcase;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\DocumentationController;
use App\Http\Controllers\Playground\Logo3dController;

require_once 'admin.php';

Route::get('/nl/l/{slug}', [LandingPageController::class, 'index'])->name('landing.show');

Route::prefix(RoutePrefix::setLocale())
    ->middleware('language')
    ->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('home');

        Route::get('/realisaties', [ShowcaseController::class, 'index'])->name('our-realizations');
        Route::get('/realisaties/{showcase}', [ShowcaseController::class, 'show'])->name('showcase');

        Route::get('/producten', [ProductController::class, 'index'])->name('our-products');
        Route::get('/producten/{showcase}', [ProductController::class, 'show'])->name('showcase');

        Route::get('/playground/logo-3d', Logo3dController::class)->name('playground.logo-3d');

        Route::localized(WebRoutes::SERVICES, [ExpertiseController::class, 'show'])
            ->name('our-expertise');

        Route::localized(WebRoutes::SERVICES_WEB, [ExpertiseController::class, 'webontwikkeling'])
            ->name('our-expertise.webontwikkeling');

        Route::localized(WebRoutes::SERVICES_APP, [ExpertiseController::class, 'apps'])
            ->name('our-expertise.apps');

        Route::localized(WebRoutes::SERVICES_ARCHITECTURE, [ExpertiseController::class, 'architectuur'])
            ->name('our-expertise.architectuur');

        Route::localized(WebRoutes::SERVICES_AI, [ExpertiseController::class, 'ai'])
            ->name('our-expertise.artificial-intelligence');

        Route::localized(WebRoutes::SERVICES_IOT, [ExpertiseController::class, 'iot'])
            ->name('our-expertise.iot');

        Route::localized(WebRoutes::ABOUT_US, [AboutUsController::class, 'show'])->name('about-libaro');

        Route::get('/jobs', [VacanciesController::class, 'index'])->name('vacancies');
        Route::get('/jobs/{vacancy}', [VacanciesController::class, 'show'])->name('vacancies.show');

        Route::get('/contact', [ContactUsController::class, 'show'])->name('contact-us');
        Route::post('/contact-form', ContactForm::class)->name('contact-form')
            ->middleware(ProtectAgainstSpam::class);

        Route::get('/blog', [ArticleController::class, 'index'])->name('articles');
        Route::get('/blog/{article}', [ArticleController::class, 'show'])->name('articles.show');

        Route::get('/clients/{client}', ClientRandomShowcase::class)->name('client.showcase');

        Route::get('/privacy', PrivacyPage::class)->name('privacy');
        Route::get('/cookie', CookiesPage::class)->name('cookie');
        Route::get('/terms', TermsPage::class)->name('terms');

        Route::get('/docs', [DocumentationController::class, 'index'])->name('docs');
        Route::get('/docs/{repository}/{path?}', [DocumentationController::class, 'show'])
            ->name('docs.show')
            ->where('path', '(.*)');

        Route::get('/assets', AssetsController::class)->name('assets');

        Route::get('script', function () {
            $lc = new \App\Services\LandingPageGenerator();
            $lc->handle();
        });


        Route::get('/timecard/integration', function () {
            return view('pages.timecard.integration');
        })->name('timecard-integration');

        Route::get('/timecard/support', \App\Http\Controllers\Timecard\SupportController::class)->name('timecard-support');

        Route::get('{any}', function () {
            abort(404);
        })->where('any', '.*');

    });

Route::get('/', RedirectController::class)->name('home');
