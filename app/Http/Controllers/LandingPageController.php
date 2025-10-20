<?php

namespace App\Http\Controllers;

use App\Http\Resources\LandingPageResource;
use App\Models\LandingPage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class LandingPageController extends Controller
{
    public function __invoke(string $locale, LandingPage $landingPage): Response|RedirectResponse
    {
        $defaultLocale = config('app.default_locale');

        if ($locale !== $defaultLocale) {
            return Redirect::action(self::class, ['locale' => $defaultLocale, 'landingPage' => $landingPage], 301);
        }

        $landingPage->loadMissing('projects.client');

        return (new HomeController)->render([
            'landingPage' => Inertia::defer(fn () => LandingPageResource::make($landingPage)),
        ]);
    }
}
