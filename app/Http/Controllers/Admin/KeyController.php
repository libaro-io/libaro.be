<?php

namespace App\Http\Controllers\Admin;

use App\Models\Key;
use App\Models\Showcase;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class KeyController extends Controller
{
    /**
     * Return a view to view and edit a Key
     *
     * @param Showcase $showcase
     * @param Key $key
     * @return View
     */
    public function edit(Showcase $showcase, Key $key): View
    {
        return view('admin.keys.edit', ['showcase' => $showcase, 'key' => $key, 'title' => 'Edit Key']);
    }

    /**
     * Update the given Key
     * Redirect back to the edit view of the Showcase this key belongs to
     *
     * @param Showcase $showcase
     * @param Key $key
     * @return RedirectResponse
     */
    public function update(Showcase $showcase, Key $key): RedirectResponse
    {
        $validated = request()->validate([
            'visible' => 'required|boolean',
            'number' => 'required|numeric',
            'title' => 'required|string|max:255',
            'body' => 'required'
        ]);

        $key->update($validated);

        return redirect()
            ->route('admin.showcases.edit', ['showcase' => $showcase])
            ->with('success', 'Key updated');
    }

    /**
     * Return a view to create a new Key
     *
     * @param Showcase $showcase
     * @return View
     */
    public function create(Showcase $showcase): View
    {
        return view('admin.keys.create', ['showcase' => $showcase, 'title' => 'Create Key']);
    }

    /**
     * Store a new Key in the database
     * Redirect to the edit page of the Showcase this Key belongs to
     *
     * @param Showcase $showcase
     * @return RedirectResponse
     */
    public function store(Showcase $showcase): RedirectResponse
    {
        $validated = request()->validate([
            'visible' => 'required|boolean',
            'number' => 'required|numeric',
            'title' => 'required|string|max:255',
            'body' => 'required'
        ]);

        $key = Key::make($validated);
        $key->showcase_id = $showcase->id;

        $key->save();

        return redirect()
            ->route('admin.showcases.edit', ['showcase' => $showcase])
            ->with('success', 'Key created');
    }

    /**
     * Delete the Key in the database
     * Return to the edit page of the Showcase this Key belonged to
     *
     * @param Showcase $showcase
     * @param Key $key
     * @return RedirectResponse
     */
    public function destroy(Showcase $showcase, Key $key): RedirectResponse
    {
        $key->delete();

        return redirect()
            ->route('admin.showcases.edit', ['showcase' => $showcase])
            ->with('success', 'Key deleted');
    }
}
