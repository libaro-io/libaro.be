<?php

namespace App\Http\Controllers\Playground;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class Logo3dController extends Controller
{
    public function __invoke(): View
    {
        return view('pages.playground.logo-3d');
    }
}
