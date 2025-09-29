<?php

namespace App\Http\Controllers;

use App\Http\Resources\LandingPageResource;
use App\Http\Resources\ProjectResource;
use App\Models\LandingPage;
use App\Models\Project;
use Inertia\Inertia;

class ProjectController extends Controller
{
    public function __invoke()
    {
        $projects = Project::query()
            ->with('client')
            ->where('visible', '=', true)
            ->where('is_product', '=', false)
            ->orderByDesc('date')
            ->orderBy('id')
            ->get();

        return Inertia::render('website/projects', [
            'projects' => ProjectResource::collection($projects->prepend($projects->splice(1, 1)[0])),
        ]);
    }
}
