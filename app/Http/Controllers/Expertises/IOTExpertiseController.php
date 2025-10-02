<?php

namespace App\Http\Controllers\Expertises;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class IOTExpertiseController extends BaseExpertiseController
{
    public function __invoke(): Response
    {
        return Inertia::render('website/expertise/iot',[
            'clients' => Inertia::defer(fn() => $this->getClients())
        ]);
    }
}
