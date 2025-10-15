<?php

namespace App\Http\Controllers;

use App\Http\Resources\BlogResource;
use App\Models\Blog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class BlogController extends Controller
{
    public function __invoke(): Response|RedirectResponse
    {
        if (request()->has('page') || request()->has('filter')) {
            return Redirect::action(self::class, ['locale' => app()->getLocale()], 301);
        }

        $blogs = Blog::query()
            ->where('visible', '=', true)
            ->orderByDesc('publish_date')
            ->get();

        return Inertia::render('website/blog', [
            'blogs' => BlogResource::collection($blogs),
        ]);
    }
}
