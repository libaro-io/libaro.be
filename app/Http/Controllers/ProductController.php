<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Inertia\Inertia;
use Inertia\Response;

class ProductController extends Controller
{
    public function __invoke(): Response
    {
        $products = Project::query()
            ->with('client')
            ->where('visible', '=', true)
            ->where('is_product', '=', true)
            ->orderByDesc('date')
            ->orderBy('id')
            ->get();

        return Inertia::render('website/products', [
            'products' => ProjectResource::collection($products),
        ]);
    }
}
