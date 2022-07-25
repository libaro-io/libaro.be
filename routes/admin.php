<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\CompetenceController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KeyController;
use App\Http\Controllers\Admin\QuoteController;
use App\Http\Controllers\Admin\ShowcaseController;
use App\Http\Controllers\Admin\SessionController;
use App\Http\Controllers\Admin\VacancyController;

Route::get('/login', [SessionController::class, 'create'])->middleware('guest')->name('login');
Route::post('/login', [SessionController::class, 'store'])->middleware('guest')->name('login');


Route::prefix('admin')->middleware('auth')->name('admin.')->group(function() {

    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });

    Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');

    Route::delete('/', [SessionController::class, 'delete'])->name('session.delete');
});

Route::prefix('admin')->middleware('auth')->name('admin.showcases.')->group(function() {
    Route::get('/showcases', [ShowcaseController::class, 'index'])->name('index');
    Route::get('/showcases/create', [ShowcaseController::class, 'create'])->name('create');
    Route::get('/showcases/{showcase}', [ShowcaseController::class, 'edit'])->name('edit');
    Route::post('/showcases', [ShowcaseController::class, 'store'])->name('store');
    Route::put('/showcases/{showcase}', [ShowcaseController::class, 'update'])->name('update');
    Route::delete('/showcases/{showcase}', [ShowcaseController::class, 'destroy'])->name('delete');
});

Route::prefix('admin')->middleware('auth')->name('admin.clients.')->group(function() {
    Route::get('/clients', [ClientController::class, 'index'])->name('index');
    Route::get('/clients/create', [ClientController::class, 'create'])->name('create');
    Route::get('/clients/{client}', [ClientController::class, 'edit'])->name('edit');
    Route::post('/clients', [ClientController::class, 'store'])->name('store');
    Route::put('/clients/{client}', [ClientController::class, 'update'])->name('update');
    Route::delete('/clients/{client}', [ClientController::class, 'destroy'])->name('delete');
});

Route::prefix('admin')->middleware('auth')->name('admin.vacancies.')->group(function() {
    Route::get('/vacancies', [VacancyController::class, 'index'])->name('index');
    Route::get('/vacancies/create', [VacancyController::class, 'create'])->name('create');
    Route::get('/vacancies/{vacancy}', [VacancyController::class, 'edit'])->name('edit');
    Route::post('/vacancies', [VacancyController::class, 'store'])->name('store');
    Route::put('/vacancies/{vacancy}', [VacancyController::class, 'update'])->name('update');
    Route::delete('/vacancies/{vacancy}', [VacancyController::class, 'destroy'])->name('delete');
});

Route::prefix('admin')->middleware('auth')->name('admin.articles.')->group(function() {
   Route::get('/articles', [ArticleController::class, 'index'])->name('index');
   Route::get('/articles/create', [ArticleController::class, 'create'])->name('create');
   Route::get('/articles/{article}', [ArticleController::class, 'edit'])->name('edit');
   Route::post('/articles', [ArticleController::class, 'store'])->name('store');
   Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('update');
   Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('delete');
});

Route::prefix('admin')->middleware('auth')->name('admin.competences.')->group(function() {
    Route::get('/{vacancy}/competences/create', [CompetenceController::class, 'create'])->name('create');
    Route::get('/{vacancy}/competences/{competence}', [CompetenceController::class, 'edit'])->name('edit');
    Route::post('/{vacancy}/competences', [CompetenceController::class, 'store'])->name('store');
    Route::put('/{vacancy}/competences/{competence}', [CompetenceController::class, 'update'])->name('update');
    Route::delete('/{vacancy}/competences/{competence}', [CompetenceController::class, 'destroy'])->name('delete');
});

Route::prefix('admin')->middleware('auth')->name('admin.keys.')->group(function() {
    Route::get('/{showcase}/keys/create', [KeyController::class, 'create'])->name('create');
    Route::get('/{showcase}/keys/{key}', [KeyController::class, 'edit'])->name('edit');
    Route::post('/{showcase}/keys', [KeyController::class, 'store'])->name('store');
    Route::put('/{showcase}/keys/{key}', [KeyController::class, 'update'])->name('update');
    Route::delete('/{showcase}/keys/{key}', [KeyController::class, 'destroy'])->name('delete');
});

Route::prefix('admin')->middleware('auth')->name('admin.quotes.')->group(function() {
    Route::get('/{showcase}/quotes/create', [QuoteController::class, 'create'])->name('create');
    Route::get('/{showcase}/quotes/{quote}', [QuoteController::class, 'edit'])->name('edit');
    Route::post('/{showcase}/quotes', [QuoteController::class, 'store'])->name('store');
    Route::put('/{showcase}/quotes/{quote}', [QuoteController::class, 'update'])->name('update');
    Route::delete('/{showcase}/quotes/{quote}', [QuoteController::class, 'destroy'])->name('delete');
});
