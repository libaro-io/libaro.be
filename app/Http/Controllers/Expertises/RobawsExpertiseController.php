<?php

namespace App\Http\Controllers\Expertises;

use Inertia\Inertia;
use Inertia\Response;

class robawsExpertiseController extends BaseExpertiseController
{
    public function __invoke(): Response
    {
        return Inertia::render('website/expertise/robaws', [
            'clients' => Inertia::defer(fn () => $this->getClients()),
        ]);
    }
}
