<?php

namespace App\Http\Controllers\Expertises;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClientResource;
use App\Http\Resources\ProjectResource;
use App\Models\Client;
use App\Models\Project;
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

    protected function getProjects(string $type)
    {
        return Project::query()
            ->with('client')
            ->where('visible', '=', true)
            ->where('is_product', '=', false)
            ->where('type', '=', $type)
            ->get()
            ->map(fn(Project $project) => ProjectResource::make($project));
    }

}
