<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class AboutUsController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('website/about-us');
    }
}
