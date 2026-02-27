<?php

use App\Http\Controllers\ExperienceChatController;
use App\Http\Controllers\SmartFilterController;
use Illuminate\Support\Facades\Route;

Route::post('experience-chat', ExperienceChatController::class)
    ->middleware('throttle:10,1');
Route::post('experience-chat/format-for-contact', [ExperienceChatController::class, 'formatForContact'])
    ->middleware('throttle:10,1');
Route::post('smart-filter', SmartFilterController::class)
    ->middleware('throttle:10,1');
