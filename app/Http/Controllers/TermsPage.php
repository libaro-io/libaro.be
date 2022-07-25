<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ValueObjects\Domains;

class TermsPage extends Controller
{
    public function __invoke(Request $request)
    {
        $request->session()->put('domain', Domains::TERMS);

        return view('pages.terms');
    }
}
