<?php

namespace App\Http\Middleware;

use App\Http\Controllers\HomeController;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $currentLocale = $request->route()?->parameter('locale');

        if(is_null($currentLocale)){
            return redirect()->action(HomeController::class, ['locale' => app()->getLocale()]);
        }

        $supportedLocales = config('app.supported_locales');
        if (!in_array($currentLocale, $supportedLocales)) {
            abort(404);
        }

        return $next($request);
    }
}
