<?php

use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return \Inertia\Inertia::render('test/test');
});
