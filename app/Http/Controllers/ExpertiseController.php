<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ValueObjects\Domains;

class ExpertiseController extends Controller
{
    public function show(Request $request)
    {
        $request->session()->put('domain', Domains::EXPERTISE);

        return view('pages.expertise');
    }

    public function webontwikkeling(Request $request)
    {
        $request->session()->put('domain', Domains::EXPERTISE);

        return view('pages.expertise.webontwikkeling');
    }

    public function apps(Request $request)
    {
        $request->session()->put('domain', Domains::EXPERTISE);

        return view('pages.expertise.apps');
    }

    public function architectuur(Request $request)
    {
        $request->session()->put('domain', Domains::EXPERTISE);

        return view('pages.expertise.architectuur');
    }

    public function iot(Request $request)
    {
        $request->session()->put('domain', Domains::EXPERTISE);

        return view('pages.expertise.iot');
    }
}
