<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;

class AssetsController extends Controller
{
    public function __invoke()
    {
        return view('pages.assets');
    }
}
