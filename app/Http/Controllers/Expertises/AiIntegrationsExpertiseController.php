<?php

namespace App\Http\Controllers\Expertises;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class AiIntegrationsExpertiseController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('website/expertise/ai-integrations');
    }
}
