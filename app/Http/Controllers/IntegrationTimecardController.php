<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class IntegrationTimecardController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('website/integration-timecard', []);
    }
}
