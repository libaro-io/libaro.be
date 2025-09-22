<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class UpdateLangController extends Controller
{
    public function __invoke(Request $request){
        App::setLocale($request->language);
        session()->put('locale', $request->language);
        return redirect()->back();
    }
}
