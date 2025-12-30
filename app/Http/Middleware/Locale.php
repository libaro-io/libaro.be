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
     * @param  Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $currentLocale = $request->route()?->parameter('locale');

        if ((is_object($currentLocale) || is_null($currentLocale)) && $request->path() === '/') {
            return redirect()->action(HomeController::class, ['locale' => app()->getLocale()]);
        }

        $supportedLocales = config('app.supported_locales');
        $isSupportedLocale = in_array($currentLocale, $supportedLocales);
        $isAnAdminRoute = str_starts_with($request->path(), config('filament.path'));
        $isALivewireRoute = str_starts_with($request->path(), 'livewire');
        $isBannerRoute = $request->path() === 'banner';

        if ($isSupportedLocale) {
            app()->setLocale(is_string($currentLocale) ? $currentLocale : config('app.locale'));

            return $next($request);
        }

        if ($isAnAdminRoute) {
            return $next($request);
        }

        if ($isALivewireRoute) {
            return $next($request);
        }

        if ($isBannerRoute) {
            return $next($request);
        }

        abort(404);
    }
}
