<?php

namespace App\Http\Controllers\Industries;

use Inertia\Inertia;
use Inertia\Response;

class WasteProcessingIndustryController extends BaseIndustryController
{
    public function __invoke(): Response
    {
        return Inertia::render('website/industry/waste-processing');
    }
}
