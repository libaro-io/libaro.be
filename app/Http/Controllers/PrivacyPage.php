<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ValueObjects\Domains;

class PrivacyPage extends Controller
{
    public function __invoke(Request $request)
    {
        $request->session()->put('domain', Domains::PRIVACY);

        return view('pages.privacy');
    }
}
