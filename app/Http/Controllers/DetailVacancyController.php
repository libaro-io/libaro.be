<?php

namespace App\Http\Controllers;

use App\Http\Resources\VacancyResource;
use App\Models\Vacancy;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class DetailVacancyController extends Controller
{
    public function __invoke(string $locale, Vacancy $vacancy): Response|RedirectResponse
    {
        $defaultLocale = config('app.default_locale');

        if ($locale !== $defaultLocale) {
            return Redirect::action(self::class, ['locale' => $defaultLocale, 'vacancy' => $vacancy], 301);
        }

        $vacancy->loadMissing(['blocks']);

        return Inertia::render('website/vacancy', [
            'vacancy' => VacancyResource::make($vacancy),
        ]);
    }
}
