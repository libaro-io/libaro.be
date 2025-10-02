<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class PrivacyPolicyController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('website/privacy-policy');
    }
}
