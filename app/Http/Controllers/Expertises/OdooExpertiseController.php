<?php

namespace App\Http\Controllers\Expertises;

use Inertia\Inertia;
use Inertia\Response;

class OdooExpertiseController extends BaseExpertiseController
{
    public function __invoke(): Response
    {
        return Inertia::render('website/expertise/odoo');
    }
}
