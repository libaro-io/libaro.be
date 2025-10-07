<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Inertia\Inertia;
use Inertia\Response;

class DetailProductController extends Controller
{
    public function __invoke(string $locale, Project $product): Response
    {
        $product->loadMissing(['blocks', 'client']);

        return Inertia::render('website/project', [
            'project' => ProjectResource::make($product),
        ]);
    }
}
