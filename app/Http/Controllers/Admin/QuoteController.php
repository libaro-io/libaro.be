<?php

namespace App\Http\Controllers\Admin;

use App\Models\Quote;
use App\Models\Showcase;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;

class QuoteController extends Controller
{
    /**
     * Show the create page for a new Quote
     *
     * @param Showcase $showcase
     * @return View
     * @returnView
     */
    public function create(Showcase $showcase): View
    {
        return view('admin.quotes.create', ['showcase' => $showcase, 'title' => 'Create Quote']);
    }

    /**
     * Store a new Quote in the database
     * Return to the edit page of the Showcase this Quote belongs to
     *
     * @param Showcase $showcase
     * @return RedirectResponse
     */
    public function store(Showcase $showcase): RedirectResponse
    {
        $validated = request()->validate([
            'visible' => 'required|boolean',
            'body' => 'required|string',
            'by' => 'required|string|max:255',
            'job_title' => 'required|string|max:255',
            'image_person' => 'required|image'
        ]);

        $quote = Quote::make($validated);
        $quote->showcase_id = $showcase->id;

        $quote->save();

        if(request()->has('image_person')) {
            $quote
                ->addMediaFromRequest('image_person')
                ->toMediaCollection('quote');
        }

        return redirect()
            ->route('admin.showcases.edit', ['showcase' => $showcase])
            ->with('success', 'Quote created');
    }

    /**
     * Show the edit page for the given Quote
     *
     * @param Showcase $showcase
     * @param Quote $quote
     * @return View
     */
    public function edit(Showcase $showcase, Quote $quote): View
    {
        return view('admin.quotes.edit', ['showcase' => $showcase, 'quote' => $quote, 'title' => 'Edit Quote']);
    }

    /**
     * Update the given Quote
     * Redirect to the edit page of the Showcase this Quote belongs to
     *
     * @param Showcase $showcase
     * @param Quote $quote
     * @return RedirectResponse
     */
    public function update(Showcase $showcase, Quote $quote): RedirectResponse
    {
        $validated = request()->validate([
            'visible' => 'required|boolean',
            'body' => 'required|string',
            'by' => 'required|string|max:255',
            'job_title' => 'required|string|max:255',
            'image_person' => 'image'
        ]);

        $quote->update($validated);

        try {
            if (request()->has('image_person')) {
                $quote->clearMediaCollection('quote');

                $quote
                    ->addMediaFromRequest('image_person')
                    ->toMediaCollection('quote');
            }
        } catch (FileDoesNotExist | FileIsTooBig $e) {
            info('QuoteController::update');
            info($e->getMessage());
        }

        return redirect()
            ->route('admin.showcases.edit', ['showcase' => $showcase])
            ->with('success', 'Quote updated');
    }

    /**
     * Delete the given Quote
     * Redirect to the edit page of the Showcase this Quote belonged to
     *
     * @param Showcase $showcase
     * @param Quote $quote
     * @return RedirectResponse
     */
    public function destroy(Showcase $showcase, Quote $quote): RedirectResponse
    {
        $quote->delete();

        return redirect()
            ->route('admin.showcases.edit', ['showcase' => $showcase])
            ->with('success', 'Quote deleted');
    }
}
