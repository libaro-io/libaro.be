<?php

namespace App\Http\Controllers;

use App\Http\Resources\BlogResource;
use App\Models\Blog;
use Inertia\Inertia;

class BlogController extends Controller
{
    public function __invoke()
    {
        $blogs = Blog::query()
            ->where('visible', '=', true)
            ->orderByDesc('publish_date')
            ->get();

        return Inertia::render('website/blog', [
            'blogs' => BlogResource::collection($blogs->prepend($blogs->splice(1, 1)[0])),
        ]);
    }
}
