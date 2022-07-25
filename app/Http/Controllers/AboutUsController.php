<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ValueObjects\Domains;

class AboutUsController extends Controller
{
    public function show(Request $request)
    {
        $request->session()->put('domain', Domains::LIBARO);

        return view('pages.about-us');
    }
}
