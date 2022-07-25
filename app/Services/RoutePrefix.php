<?php
declare(strict_types=1);


namespace App\Services;


final class RoutePrefix
{
    /**
     * Illuminate translator class.
     *
     * @var \Illuminate\Translation\Translator
     */
    protected $translator;

    /**
     * Illuminate router class.
     *
     * @var \Illuminate\Routing\Router
     */
    protected $router;

    /**
     * Illuminate request class.
     *
     * @var \Illuminate\Routing\Request
     */
    protected $request;

    /**
     * Illuminate url class.
     *
     * @var \Illuminate\Routing\UrlGenerator
     */
    protected $url;

    /**
     * Illuminate request class.
     *
     * @var Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * @var array
     */
    private $supportedLocales;

    public function __construct()
    {
        $this->app = app();

        $this->translator = $this->app['translator'];
        $this->router = $this->app['router'];
        $this->request = $this->app['request'];
        $this->url = $this->app['url'];
        $this->supportedLocales = array_fill_keys($this->app['config']['app.supported_locales'], []);
    }

    public static function setLocale(string $locale = null)
    {
        return (new self)->setAndGetLocale($locale);
    }

    /**
     * Set and return current locale.
     *
     * @param string|null $locale Locale to set the App to (optional)
     *
     * @return string Returns locale (if route has any) or null (if route does not have a locale)
     */
    public function setAndGetLocale(string $locale = null)
    {
        if (empty($locale) || !\is_string($locale)) {
            // If the locale has not been passed through the function
            // it tries to get it from the first segment of the url
            $locale = $this->request->segment(1);
        }

        if (($this->supportedLocales[$locale] ?? null) !== null) {
            $this->currentLocale = $locale;
        } else {
            // if the first segment/locale passed is not valid
            // the system would ask which locale have to take
            // it could be taken by the browser
            // depending on your configuration

            $locale = null;

            // but if hideDefaultLocaleInURL is false, we have
            // to retrieve it from the browser...
            $this->currentLocale = config('app.locale');
        }

        $this->app->setLocale($this->currentLocale);

        // Regional locale such as de_DE, so formatLocalized works in Carbon

        return $locale;
    }
}
