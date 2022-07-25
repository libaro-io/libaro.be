<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ValueObjects\Domains;

class HomeController
{
    public function index(Request $request)
    {
        $request->session()->put('domain', Domains::HOME);

        return view('index');
    }
}
