<?php

namespace App\Http\Controllers;

use App\Http\Resources\VacancyResource;
use App\Models\Vacancy;
use Inertia\Inertia;
use Inertia\Response;

class VacancyController extends Controller
{
    public function __invoke(): Response
    {
        $vacancies = Vacancy::query()
            ->where('visible', '=', true)
            ->get();

        return Inertia::render('website/vacancies', [
            'vacancies' => VacancyResource::collection($vacancies),
        ]);
    }
}
