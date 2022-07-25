<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Show the dashboard view
     *
     * @return View
     */
    public function show(): View
    {
        return view('admin.dashboard', ['title' => 'Dashboard']);
    }
}
