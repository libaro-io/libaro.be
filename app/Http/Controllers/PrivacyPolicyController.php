<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class PrivacyPolicyController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('website/privacy-policy');
    }
}
