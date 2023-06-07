<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use App\Models\Showcase;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use Illuminate\Http\RedirectResponse;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;

class ClientController extends Controller
{
    /**
     * Show index page with all Clients
     *
     * @return View
     */
    public function index(): View
    {
        return view('admin.clients.index', ['title' => 'Clients', 'clients' => Client::paginate()]);
    }

    /**
     * Show page to create a new Client
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.clients.create', ['title' => 'Create Client']);
    }

    /**
     * Store a new Client in the database
     * Redirect to the clients index page
     *
     * @param ClientRequest $request
     * @return RedirectResponse
     */
    public function store(ClientRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        unset($validated['logo']);

        $client = Client::create($validated);

        $client
            ->addMediaFromRequest('logo')
            ->toMediaCollection('client_logo');

        return redirect()
            ->route('admin.clients.index')
            ->with('success', 'Client Created');
    }

    /**
     * Show edit page for the given Client
     *
     * @param Client $client
     * @return View
     */
    public function edit(Client $client): View
    {
        return view('admin.clients.edit', ['client' => $client, 'title' => 'Edit Client']);
    }

    /**
     * Update the given client
     * Redirect to the edit page of the client
     *
     * @param ClientRequest $request
     * @param Client $client
     * @return RedirectResponse
     */
    public function update(ClientRequest $request, Client $client): RedirectResponse
    {
        $validated = $request->validated();

        if(request()->has('logo')) {
            $client->clearMediaCollection('client_logo');

            try {
                $client
                    ->addMediaFromRequest('logo')
                    ->toMediaCollection('client_logo');
            } catch (FileDoesNotExist | FileIsTooBig $e) {
                info('ClientController::update');
                info($e->getMessage());
            }
        }

        unset($validated['logo']);

        $client->update($validated);

        return redirect()
            ->route('admin.clients.edit', ['client' => $client])
            ->with('success', 'Client updated');
    }

    /**
     * Remove the client from the database
     * Redirect to the clients index page
     *
     * @param Client $client
     * @return RedirectResponse
     */
    public function destroy(Client $client): RedirectResponse
    {
        Showcase::where('client_id', $client->id)->update(['client_id' => null]);

        $client->delete();

        return redirect()
            ->route('admin.clients.index')
            ->with('success', 'Client Removed');
    }
}
