<?php

namespace App\Http\Controllers\Industries;

use Inertia\Inertia;
use Inertia\Response;

class SportsClubsIndustryController extends BaseIndustryController
{
    public function __invoke(): Response
    {
        return Inertia::render('website/industry/sports-clubs');
    }
}
