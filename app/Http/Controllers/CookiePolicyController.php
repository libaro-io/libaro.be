<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class CookiePolicyController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('website/cookie-policy');
    }
}
