<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class AssetsController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('website/assets');
    }
}
