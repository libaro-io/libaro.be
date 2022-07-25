<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\ValueObjects\WebRoutes;

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
        $path = $request->path();

        if (!(str_starts_with($path, 'en') || str_starts_with($path, 'nl'))) {
            $preferredLanguageArray = explode('_', $request->getPreferredLanguage());
            $preferredLanguage = array_shift($preferredLanguageArray);
            $locale = $preferredLanguage === 'nl' ? 'nl' : 'en';

            if($locale === 'nl') {
                return redirect("$locale/$path");
            } else {
                return redirect("$locale");
            }

        }

        if ($match = WebRoutes::getTranslatedRoute($path)) {
            return redirect($match);
        }

        return $next($request);
    }
}
