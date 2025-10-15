<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ProjectController extends Controller
{
    public function __invoke(): Response|RedirectResponse
    {
        if (request()->has('page') || request()->has('filter')) {
            return Redirect::action(self::class, ['locale' => app()->getLocale()], 301);
        }

        $projects = Project::query()
            ->with('client')
            ->where('visible', '=', true)
            ->where('is_product', '=', false)
            ->orderByDesc('date')
            ->orderBy('id')
            ->get();

        return Inertia::render('website/projects', [
            'projects' => ProjectResource::collection($projects),
        ]);
    }
}
