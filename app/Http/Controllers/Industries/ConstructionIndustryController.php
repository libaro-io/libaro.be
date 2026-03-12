<?php

namespace App\Http\Controllers\Industries;

use Inertia\Inertia;
use Inertia\Response;

class ConstructionIndustryController extends BaseIndustryController
{
    public function __invoke(): Response
    {
        return Inertia::render('website/industry/construction');
    }
}
