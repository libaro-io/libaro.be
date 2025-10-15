<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class ClientRandomProjectController extends Controller
{
    public function __invoke(string $locale, Client $client): RedirectResponse
    {
        $project = $client->projects()->inRandomOrder()->first();

        return Redirect::action(DetailProjectController::class, ['locale' => $locale, 'project' => $project], 301);
    }
}
