<?php

namespace App\Http\Controllers\Expertises;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use Illuminate\Support\Collection;

class BaseExpertiseController extends Controller
{
    protected function getClients(): Collection
    {
        return Client::query()
            ->where('visible', 1)
            ->has('projects')
            ->orderBy('weight', 'desc')
            ->limit(5)
            ->get()
            ->map(fn(Client $client) => ClientResource::make($client));
    }

}
