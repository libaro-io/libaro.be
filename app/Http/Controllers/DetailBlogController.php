<?php

namespace App\Http\Controllers;

use App\Http\Resources\BlogResource;
use App\Models\Blog;
use Inertia\Inertia;

class DetailBlogController extends Controller
{
    public function __invoke(string $locale, Blog $blog): Response
    {
        $blog->loadMissing('blocks');

        return Inertia::render('website/blog-item', [
            'blog' => BlogResource::make($blog),
        ]);
    }
}
