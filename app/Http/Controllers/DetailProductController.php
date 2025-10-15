<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class DetailProductController extends Controller
{
    public function __invoke(string $locale, Project $product): Response|RedirectResponse
    {
        if (! $product->is_product) {
            return Redirect::action(DetailProjectController::class, [
                'locale' => $locale,
                'project' => $product->slug,
            ], 301);
        }

        $product->loadMissing(['blocks', 'client']);

        return Inertia::render('website/project', [
            'project' => ProjectResource::make($product),
        ]);
    }
}
