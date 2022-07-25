<?php

namespace App\Http\Controllers\Admin;

use App\Models\Vacancy;
use App\Traits\SanitizeTags;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\VacancyRequest;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;

class VacancyController extends Controller
{
    use SanitizeTags;

    /**
     * Return a view with all vacancies
     *
     * @return View
     */
    public function index(): View
    {
        return view('admin.vacancies.index', ['vacancies' => Vacancy::all(), 'title' => 'Vacancies']);
    }

    /**
     * Return a view to create a new vacancy
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.vacancies.create', ['title' => 'Create Vacancy']);
    }

    /**
     * Store a new Vacancy
     * Return to Vacancies index view
     *
     * @param VacancyRequest $request
     * @return RedirectResponse
     */
    public function store(VacancyRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $tags = $this->sanitizeTags($validated['tags']);
        unset($validated['tags']);

        $vacancy = Vacancy::create($validated);

        $vacancy->syncTagsWithType($tags, 'vacancy');

        $vacancy
            ->addMediaFromRequest('image')
            ->toMediaCollection('vacancy');


        return redirect()
            ->route('admin.vacancies.update', ['vacancy' => $vacancy])
            ->with('success', 'Vacancy Created');
    }

    /**
     * Return a view to edit the given Vacancy
     *
     * @param Vacancy $vacancy
     * @return View
     */
    public function edit(Vacancy $vacancy): View
    {
        return view('admin.vacancies.edit', ['vacancy' => $vacancy, 'title' => 'Edit Vacancy']);
    }

    /**
     * @param VacancyRequest $request
     * @param Vacancy $vacancy
     * @return RedirectResponse
     */
    public function update(VacancyRequest $request, Vacancy $vacancy): RedirectResponse
    {
        $validated = $request->validated();

        $vacancy->syncTagsWithType($this->sanitizeTags($validated['tags']), 'vacancy');

        unset($validated['tags']);

        if(request()->has('image')) {
            $vacancy->clearMediaCollection('vacancy');

            try {
                $vacancy
                    ->addMediaFromRequest('image')
                    ->toMediaCollection('vacancy');
            } catch (FileDoesNotExist | FileIsTooBig $e) {
                info('VacancyController::update');
                info($e->getMessage());
            }
        }

        $vacancy->update($validated);

        return redirect()
            ->route('admin.vacancies.edit', ['vacancy' => $vacancy])
            ->with('success', 'Vacancy Updated');
    }

    /**
     * Delete the given Vacancy
     * Including its stored image and attached keys and tags
     *
     * @param Vacancy $vacancy
     * @return RedirectResponse
     */
    public function destroy(Vacancy $vacancy): RedirectResponse
    {
        DB::table('competences')->where('vacancy_id', $vacancy->id)->delete();

        $vacancy->delete();

        return redirect()
            ->route('admin.vacancies.index')
            ->with('success', 'Vacancy Deleted');
    }
}
