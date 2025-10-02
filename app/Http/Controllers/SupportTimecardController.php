<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class SupportTimecardController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('website/support-timecard', []);
    }
}
