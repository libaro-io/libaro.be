<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ValueObjects\Domains;

class CookiesPage extends Controller
{
    public function __invoke(Request $request)
    {
        $request->session()->put('domain', Domains::COOKIES);

        return view('pages.cookies');
    }
}
