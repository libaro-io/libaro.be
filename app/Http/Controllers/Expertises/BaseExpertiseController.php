<?php

namespace App\Http\Controllers\Expertises;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Support\Collection;

class BaseExpertiseController extends Controller
{
    /**
     * @return Collection<int, ProjectResource>
     */
    protected function getProjects(string $type): Collection
    {
        return Project::query()
            ->with('client')
            ->where('visible', '=', true)
            ->where('is_product', '=', false)
            ->where('type', '=', $type)
            ->get()
            ->map(fn (Project $project) => ProjectResource::make($project));
    }

    /**
     * @return Collection<int, ProjectResource>
     */
    protected function getProjectsByTags(string $tag): Collection
    {
        return Project::query()
            ->with('client')
            ->where('visible', '=', true)
            ->where('is_product', '=', false)
            ->where('tags', 'like', '%' . $tag . '%')
            ->get()
            ->map(fn (Project $project) => ProjectResource::make($project));
    }
}
