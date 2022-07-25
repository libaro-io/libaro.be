<?php

namespace App\Http\Controllers;

use App\Services\Github;
use App\Models\Repository;
use Illuminate\Http\Request;
use App\ValueObjects\Domains;

class DocumentationController
{
    public function index(Request $request)
    {
        $request->session()->put('domain', Domains::DOCS);

        $repositories = Github::getRepositories()->map(function($repository) {
            return $repository->take(['slug', 'name', 'description', 'lastUpdated', 'lastRelease']);
        });

        return view('documentation.index', ['repositories' => $repositories]);
    }

    public function show($slug, $path = 'README.md', Request $request)
    {
        $request->session()->put('domain', Domains::DOCS);

        $repositories = Github::getRepositories();

        /** @var Repository $repository */
        $repository = $repositories->first(function ($repo) use ($slug) {
            return $repo->slug() === $slug;
        });

        if(!$repository) {
            abort(404);
        }

        $obj = $repository->take(['url', 'slug', 'name', 'description', 'lastUpdated', 'lastRelease', 'isPrerelease', 'documentationMenu']);

        $obj->file = $repository->getFile($path);

        return view('documentation.show', ['repository' => $obj, 'current' => $path]);
    }
}
