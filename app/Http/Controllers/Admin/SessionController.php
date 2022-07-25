<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Redirector;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    /**
     * Show the login page
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.login');
    }

    /**
     * Attempt to log the user in
     *
     * @return RedirectResponse
     */
    public function store(): RedirectResponse
    {
        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (! auth()->attempt($attributes)) {
            throw ValidationException::withMessages([
                'email' => 'Your provided credentials could not be verified.'
            ]);
        }

        session()->regenerate();

        return redirect()->route('admin.showcases.index')->with('success', 'Welcome Back!');
    }

    /**
     * Log the user out
     *
     * @return Redirector
     */
    public function delete()
    {
        auth()->logout();

        return redirect('/');
    }
}
