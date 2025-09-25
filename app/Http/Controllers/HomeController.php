<?php

namespace App\Http\Controllers;


use App\Http\Resources\ClientResource;
use App\Http\Resources\ProjectResource;
use App\Models\Client;
use App\Models\Project;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('website/home', [
            'clients' => Inertia::defer(fn() => $this->getClients()),
            'projects' => $this->getProjects()
        ]);
    }

    private function getClients(): LengthAwarePaginator
    {
        return Client::query()
            ->where('visible', 1)
            ->has('projects')
            ->orderBy('weight', 'desc')
            ->paginate(5)
            ->through(fn(Client $client) => ClientResource::make($client));
    }

    private function getProjects(): AnonymousResourceCollection
    {
        $randomShowcaseIds = Project::query()
            ->where('visible', true)
            ->where('pin_on_homepage', '=', 1)
            ->select('id')
            ->pluck('id')
            ->whenNotEmpty(fn (Collection $c) => $c->random(3));


        $projects = Project::query()
            ->with('client')
            ->with('media')
            ->whereIn('id', $randomShowcaseIds)
            ->get();
        return ProjectResource::collection($projects);
    }
}
