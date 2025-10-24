<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class DetailProjectController extends Controller
{
    public function __invoke(string $locale, Project $project): Response|RedirectResponse
    {
        if ($project->is_product) {
            return Redirect::action(DetailProductController::class, [
                'locale' => $locale,
                'product' => $project->slug,
            ], 301);
        }

        $project->loadMissing(['blocks', 'client']);

        $projects = Project::query()
            ->with('client')
            ->where('visible', '=', true)
            ->inRandomOrder()
            ->get()
            ->map(fn (Project $project) => ProjectResource::make($project));

        return Inertia::render('website/project', [
            'project' => ProjectResource::make($project),
            'projects' => $projects,
        ]);
    }
}
