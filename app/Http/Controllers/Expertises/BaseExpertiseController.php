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
            ->with(['client', 'tags', 'projectType'])
            ->where('visible', '=', true)
            ->where('is_product', '=', false)
            ->whereHas('projectType', fn ($query) => $query->where('slug', '=', $type))
            ->get()
            ->map(fn (Project $project) => ProjectResource::make($project));
    }

    /**
     * @return Collection<int, ProjectResource>
     */
    protected function getProjectsByTags(string $tag): Collection
    {
        return Project::query()
            ->with(['client', 'tags', 'projectType'])
            ->where('visible', '=', true)
            ->where('is_product', '=', false)
            ->whereHas('tags', fn ($query) => $query->where('name->nl', 'like', "%{$tag}%")
                ->orWhere('name->en', 'like', "%{$tag}%"))
            ->get()
            ->map(fn (Project $project) => ProjectResource::make($project));
    }
}
