<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Inertia\Inertia;

class DetailProjectController extends Controller
{
    public function __invoke(string $locale, Project $project)
    {
        $project->loadMissing('blocks');

        return Inertia::render('website/project', [
            'project' => ProjectResource::make($project)
        ]);
    }
}
