<?php

namespace App\Http\Controllers;

use App\Models\LandingPage;
use App\ValueObjects\Domains;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index(Request $request, $slug)
    {
        $request->session()->put('domain', Domains::HOME);

        $landingPage = LandingPage::query()
            ->where('slug', $slug)
            ->firstOrFail();

        return view('landing.landing', compact('landingPage'));
    }
}
