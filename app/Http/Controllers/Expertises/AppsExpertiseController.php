<?php

namespace App\Http\Controllers\Expertises;

use Inertia\Inertia;
use Inertia\Response;

class AppsExpertiseController extends BaseExpertiseController
{
    public function __invoke(): Response
    {
        return Inertia::render('website/expertise/apps', [
            'projects' => Inertia::defer(fn () => $this->getProjects('app')),
        ]);
    }
}
