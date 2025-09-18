<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::prefix('{locale?}')->group(function () {
    Route::get('/', HomeController::class);
});
