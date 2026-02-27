<?php

use App\Http\Controllers\ExperienceChatController;
use Illuminate\Support\Facades\Route;

Route::post('experience-chat', ExperienceChatController::class)
    ->middleware('throttle:10,1');
