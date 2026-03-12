<?php

namespace App\Http\Controllers\Industries;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Support\Collection;

class BaseIndustryController extends Controller
{
    /**
     * @return Collection<int, ProjectResource>
     */
    protected function getProjectsBySector(string $sector): Collection
    {
        return Project::query()
            ->with('client')
            ->where('visible', '=', true)
            ->where('is_product', '=', false)
            ->where('sector', '=', $sector)
            ->get()
            ->map(fn (Project $project) => ProjectResource::make($project));
    }
}
