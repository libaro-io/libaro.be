<?php

namespace App\Http\Controllers;

use App\Http\Resources\LandingPageResource;
use App\Models\LandingPage;
use Inertia\Response;

class LandingPageController extends Controller
{
    public function __invoke(string $locale = null, LandingPage $landingPage = null): Response
    {
        $landingPage->loadMissing('projects.client');

        return (new HomeController())->render([
            'landingPage' => LandingPageResource::make($landingPage),
        ]);
    }
}
