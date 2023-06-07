<?php

namespace App\Http\Controllers\Admin;

use App\Models\Showcase;
use App\Traits\SanitizeTags;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ShowcaseRequest;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;

class ShowcaseController extends Controller
{
    use SanitizeTags;

    /**
     * Show a view with a paginated list of Showcases
     *
     * @return View
     */
    public function index(): View
    {
        return view('admin.showcases.index', ['showcases' => Showcase::paginate(25), 'title' => 'Showcases']);
    }

    /**
     * Return a view to create a new Showcase
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.showcases.create', ['title' => "Create Showcase"]);
    }

    /**
     * Store a new Showcase
     * Redirect to the edit page of the created Showcase
     *
     * @param ShowcaseRequest $request
     * @return RedirectResponse
     */
    public function store(ShowcaseRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $tags = $this->sanitizeTags($validated['tags']);

        unset(
            $validated['tags'],
            $validated['image_card'],
            $validated['image_header'],
            $validated['image_extra'],
            $validated['image_logo'],
        );

        $showcase = Showcase::create($validated);
        $showcase->syncTags($tags);

        if($request->has('image_card')) {
            $showcase
                ->addMediaFromRequest('image_card')
                ->toMediaCollection('showcase_card');
        }

        if($request->has('image_header')) {
            $showcase
                ->addMediaFromRequest('image_header')
                ->toMediaCollection('showcase_header');
        }

        if($request->has('image_extra')) {
            $showcase
                ->addMediaFromRequest('image_extra')
                ->toMediaCollection('showcase_extra');
        }

        if($request->has('image_logo')) {
            $showcase
                ->addMediaFromRequest('image_logo')
                ->toMediaCollection('showcase_logo');
        }

        return redirect()->route('admin.showcases.edit', ['showcase' => $showcase])->with('success', 'Showcase created');
    }

    /**
     * Show the edit page for the given Showcase
     *
     * @param Showcase $showcase
     * @return View
     */
    public function edit(Showcase $showcase): View
    {
        return view('admin.showcases.edit', ['showcase' => $showcase, 'title' => "Edit Showcase"]);
    }

    /**
     * Update the given Showcase
     * Redirect to the edit page of the given Showcase
     *
     * @param Showcase $showcase
     * @return RedirectResponse
     */
    public function update(ShowcaseRequest $request, Showcase $showcase): RedirectResponse
    {
        $validated = $request->validated();

        $showcase->syncTags($this->sanitizeTags($validated['tags']));

        unset(
            $validated['tags'],
            $validated['image_card'],
            $validated['image_header'],
            $validated['image_extra'],
            $validated['image_logo'],
        );

        try {
            if ($request->has('image_card')) {
                $showcase->clearMediaCollection('showcase_card');

                $showcase
                    ->addMediaFromRequest('image_card')
                    ->toMediaCollection('showcase_card');
            }

            if ($request->has('image_header')) {
                $showcase->clearMediaCollection('showcase_header');

                $showcase
                    ->addMediaFromRequest('image_header')
                    ->toMediaCollection('showcase_header');
            }

            if ($request->has('image_extra')) {
                $showcase->clearMediaCollection('showcase_extra');

                $showcase
                    ->addMediaFromRequest('image_extra')
                    ->toMediaCollection('showcase_extra');
            }

            if ($request->has('image_logo')) {
                $showcase->clearMediaCollection('showcase_logo');

                $showcase
                    ->addMediaFromRequest('image_logo')
                    ->toMediaCollection('showcase_logo');
            }
        } catch (FileDoesNotExist | FileIsTooBig $e) {
            info('ShowcaseController::update');
            info($e->getMessage());
        }

        $showcase->update($validated);

        return redirect()->route('admin.showcases.edit', ['showcase' => $showcase->fresh()])->with('success', 'Showcase updated');
    }

    /**
     * Delete the given Showcase including it's stored image and related Keys and Quotes
     * Redirect to the Showcases index page
     *
     * @param Showcase $showcase
     * @return RedirectResponse
     */
    public function destroy(Showcase $showcase): RedirectResponse
    {
        DB::transaction(function () use ($showcase) {
            DB::table('keys')->where('showcase_id', $showcase->id)->delete();

            $quotes = $showcase->quotes();

            foreach ($quotes as $quote) {
                $quote->delet();
            }

            $showcase->delete();
        });

        return redirect()->route('admin.showcases.index')->with('success', 'Showcase deleted');
    }
}
