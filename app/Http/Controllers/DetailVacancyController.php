<?php

namespace App\Http\Controllers;

use App\Http\Resources\VacancyResource;
use App\Models\Vacancy;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class DetailVacancyController extends Controller
{
    public function __invoke(string $locale, Vacancy $vacancy): Response|RedirectResponse
    {
        $vacancy->loadMissing(['blocks']);

        return Inertia::render('website/vacancy', [
            'vacancy' => VacancyResource::make($vacancy),
        ]);
    }
}
