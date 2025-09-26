<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class SupportTimecardController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('website/support-timecard', []);
    }
}
