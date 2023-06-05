<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\ValueObjects\WebRoutes;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class LanguageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $supportedLanguages = ['nl', 'en'];
        $path = $request->path();
        $expirationInMinutes = now()->addYear()->diffInMinutes();
        $locale = preferredLocale();
        $pathLocale = Str::of($path)->substr(0, 2);

        // If URL doens't start with supported language, we need to redirect to proper language.
        if (! in_array($pathLocale, $supportedLanguages)) {
            Cookie::queue('locale', $locale, $expirationInMinutes);

            if($locale === 'nl') {
                return redirect("$locale/$path");
            } else {
                return redirect("$locale");
            }
        }

        if ($match = WebRoutes::getTranslatedRoute($path)) {
            Cookie::queue('locale', $locale, $expirationInMinutes);
            return redirect($match);
        }

        if ($pathLocale !== $request->cookie('locale')) {
            Cookie::queue('locale', $pathLocale, $expirationInMinutes);
        }

        return $next($request);
    }
}
