<?php

namespace App\Http\Controllers\Expertises;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class WebDevelopmentExpertiseController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('website/expertise/webdevelopment');
    }
}
