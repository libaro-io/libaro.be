<?php

namespace App\Http\Controllers;

use App\Http\Resources\LandingPageResource;
use App\Models\LandingPage;
use Inertia\Inertia;
use Inertia\Response;

class LandingPageController extends Controller
{
    public function __invoke(string $locale, LandingPage $landingPage): Response
    {
        $landingPage->loadMissing('projects.client');

        return (new HomeController)->render([
            'landingPage' => Inertia::defer(fn () => LandingPageResource::make($landingPage)),
        ]);
    }
}
