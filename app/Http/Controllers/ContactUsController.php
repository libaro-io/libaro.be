<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ValueObjects\Domains;

class ContactUsController extends Controller
{
    public function show(Request $request)
    {
        $request->session()->put('domain', Domains::CONTACT);

        return view('pages.contact-us');
    }
}
