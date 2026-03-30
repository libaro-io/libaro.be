<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class SlaController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('website/sla');
    }
}
