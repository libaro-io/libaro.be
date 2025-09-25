<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class IntegrationTimecardController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('website/integration-timecard', []);
    }
}
