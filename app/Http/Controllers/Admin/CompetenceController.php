<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Competence;
use App\Models\Vacancy;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CompetenceController extends Controller
{
    /**
     * Return a view to view and edit a Competence
     *
     * @param Vacancy $vacancy
     * @param Competence $competence
     * @return View
     */
    public function edit(Vacancy $vacancy, Competence $competence): View
    {
        return view('admin.competences.edit', ['vacancy' => $vacancy, 'competence' => $competence, 'title' => 'Edit Competence']);
    }

    /**
     * Update the given Competence
     * Redirect back to the edit view of the Vacancy this competence belongs to
     *
     * @param Vacancy $vacancy
     * @param Competence $competence
     * @return RedirectResponse
     */
    public function update(Vacancy $vacancy, Competence $competence): RedirectResponse
    {
        $validated = request()->validate([
            'visible' => 'required|boolean',
            'number' => 'required|numeric',
            'title' => 'required|string|max:255',
            'body' => 'required'
        ]);

        $competence->update($validated);

        return redirect()
            ->route('admin.vacancies.edit', ['vacancy' => $vacancy])
            ->with('success', 'Competence updated');
    }

    /**
     * Return a view to create a new Competence
     *
     * @param Vacancy $vacancy
     * @return View
     */
    public function create(Vacancy $vacancy): View
    {
        return view('admin.competences.create', ['vacancy' => $vacancy, 'title' => 'Create Competence']);
    }

    /**
     * Store a new Competence in the database
     * Redirect to the edit page of the Vacancy this Competence belongs to
     *
     * @param Vacancy $vacancy
     * @return RedirectResponse
     */
    public function store(Vacancy $vacancy): RedirectResponse
    {
        $validated = request()->validate([
            'visible' => 'required|boolean',
            'number' => 'required|numeric',
            'title' => 'required|string|max:255',
            'body' => 'required'
        ]);

        $competence = Competence::make($validated);
        $competence->vacancy_id = $vacancy->id;

        $competence->save();

        return redirect()
            ->route('admin.vacancies.edit', ['vacancy' => $vacancy])
            ->with('success', 'Competence created');
    }

    /**
     * Delete the Competence in the database
     * Return to the edit page of the Vacancy this Competence belonged to
     *
     * @param Vacancy $vacancy
     * @param Competence $competence
     * @return RedirectResponse
     */
    public function destroy(Vacancy $vacancy, Competence $competence): RedirectResponse
    {
        $competence->delete();

        return redirect()
            ->route('admin.vacancies.edit', ['vacancy' => $vacancy])
            ->with('success', 'Vacancy deleted');
    }
}
