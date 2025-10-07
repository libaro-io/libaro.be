<?php

namespace App\Http\Controllers\Expertises;

use Inertia\Inertia;
use Inertia\Response;

class RobawsExpertiseController extends BaseExpertiseController
{
    public function __invoke(): Response
    {
        return Inertia::render('website/expertise/robaws');
    }
}
