<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\RedirectResponse;

class ClientRandomProjectController extends Controller
{
    public function __invoke(string $locale, Client $client): RedirectResponse
    {
        $project = $client->projects()->inRandomOrder()->first();

        return redirect()->action(DetailProjectController::class, ['locale' => $locale, 'project' => $project]);
    }
}
