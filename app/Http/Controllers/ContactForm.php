<?php

namespace App\Http\Controllers;

use App\Mail\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ContactRequest;

class ContactForm extends Controller
{
    public function __invoke(ContactRequest $request)
    {
        $validated = $request->validated();

        info('----------');
        info("New message on contactform from");
        info("IP: " . request()->ip());
        info("ClientIP: " . request()->getClientIp());
        info("UserAgent: " . request()->userAgent());
        info("Has cookie: " . request()->hasCookie('laravel_cookie_consent'));
        info('----------');

        Mail::send(new Contact($validated['name'], $validated['email'], $validated['message']));

        return back()->with('success', 'Uw bericht werd succesvol verzonden!');
    }
}
