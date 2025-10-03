<?php

namespace App\Http\Controllers\Expertises;

use Inertia\Inertia;
use Inertia\Response;

class AiIntegrationsExpertiseController extends BaseExpertiseController
{
    public function __invoke(): Response
    {
        return Inertia::render('website/expertise/ai-integrations', [
            'clients' => Inertia::defer(fn () => $this->getClients()),
        ]);
    }
}
