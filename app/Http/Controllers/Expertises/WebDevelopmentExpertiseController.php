<?php

namespace App\Http\Controllers\Expertises;

use Inertia\Inertia;
use Inertia\Response;

class WebDevelopmentExpertiseController extends BaseExpertiseController
{
    public function __invoke(): Response
    {
        return Inertia::render('website/expertise/webdevelopment', [
            'projects' => Inertia::defer(fn () => $this->getProjects('webapplicatie')),
        ]);
    }
}
