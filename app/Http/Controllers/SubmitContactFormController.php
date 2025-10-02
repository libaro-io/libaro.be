<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubmitContactFormRequest;
use App\Mail\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;

class SubmitContactFormController extends Controller
{
    public function __invoke(SubmitContactFormRequest $request): RedirectResponse
    {
        info('----------');
        info('New message on contactform from');
        info('IP: ' . request()->ip());
        info('ClientIP: ' . request()->getClientIp());
        info('UserAgent: ' . request()->userAgent());
        info('Has cookie: ' . request()->hasCookie('laravel_cookie_consent'));
        info('----------');

        Mail::to('libaro@libaro.be')->send(new Contact($request->get('name'), $request->get('email'), $request->get('message')));

        return back()->with('success', 'Uw bericht werd succesvol verzonden!');
    }
}
