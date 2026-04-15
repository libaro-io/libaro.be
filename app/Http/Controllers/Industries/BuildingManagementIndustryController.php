<?php

namespace App\Http\Controllers\Industries;

use Inertia\Inertia;
use Inertia\Response;

class BuildingManagementIndustryController extends BaseIndustryController
{
    public function __invoke(): Response
    {
        return Inertia::render('website/industry/building-management');
    }
}
