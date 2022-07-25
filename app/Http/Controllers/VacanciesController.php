<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use Illuminate\Http\Request;
use App\ValueObjects\Domains;

class VacanciesController extends Controller
{
    public function index(Request $request)
    {
        $request->session()->put('domain', Domains::VACANCIES);

        $vacancies = Vacancy::where('visible', 1)->take(3)->get();
        return view('pages.vacancies', ['vacancies' => $vacancies]);
    }

    public function show(Vacancy $vacancy, Request $request)
    {
        $request->session()->put('domain', Domains::VACANCIES);

        $alternative = Vacancy::query()->inRandomOrder()->firstWhere('id', '!=', $vacancy->id);

        return view('pages.vacancy', [
            'vacancy' => $vacancy,
            'tags' => $vacancy->getMappedTags(),
            'alternative' => $alternative
        ]);
    }
}
