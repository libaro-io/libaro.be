<?php

namespace App\Http\Controllers;

use App\Models\Client;

class ClientRandomProjectController extends Controller
{
    public function __invoke(string $locale, Client $client)
    {
        $project = $client->projects()->inRandomOrder()->first();

        return redirect()->action(DetailProjectController::class, ['locale'=>$locale,'project' => $project]);
    }
}
