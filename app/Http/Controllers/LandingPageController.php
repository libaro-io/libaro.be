<?php

namespace App\Http\Controllers;

use App\Models\Showcase;
use App\Models\LandingPage;
use Illuminate\Http\Request;
use App\ValueObjects\Domains;

class LandingPageController extends Controller
{
    public function index(Request $request, $slug)
    {
        $request->session()->put('domain', Domains::HOME);

        $showcase = Showcase::query()
        ->inRandomOrder()
        ->limit(1)
        ->first();

        $landingPage = LandingPage::query()
            ->where('slug', $slug)
            ->firstOrFail();

        return view('landing.landing', compact('landingPage', 'showcase'));
    }
}
