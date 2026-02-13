<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'pageProps' => [
                'recaptcha_site_key' => config('services.google_recaptcha.site_key'),
                'locale' => app()->getLocale(),
                'company' => [
                    'name' => 'Libaro',
                    'email' => 'jennis@libaro.be',
                    'phone' => '+32 (0)478 27 94 83',
                    'address' => [
                        'street' => 'Vaartdijkstraat',
                        'number' => '19',
                        'zip' => '8200',
                        'city' => 'Brugge',
                    ],
                    'btw' => 'BTW BE0541352248',
                    'accountNumber' => 'REK BE03 7360 0710 2484',
                ],
                'socials' => [
                    'facebook' => 'https://www.facebook.com/libaro1?fref=ts',
                    'linkedin' => 'https://www.linkedin.com/company/libaro',
                    'mail' => 'mailto:info@libaro.be',
                    'github' => 'https://github.com/libaro-io',
                ],
                'assets' => [
                    's3' => [
                        'prefix' => 'https://' . config('filesystems.disks.s3.bucket') . '.s3.eu-west-1.amazonaws.com/',
                    ],
                ],
                'url' => [
                    'search' => $request->getQueryString() ? '?' . $request->getQueryString() : '',
                    'origin' => $request->getSchemeAndHttpHost(),
                    'pathname' => $request->getPathInfo(),
                    'href' => $request->fullUrl(),
                ],
            ],
        ];
    }
}
