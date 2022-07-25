<?php

use Illuminate\Http\Request;

if(! function_exists('is_current_domain')) {
    /**
     * Use the snake case of the link name as the route name
     *
     * @param \Illuminate\Support\HtmlString|string $name
     * @return bool
     * @throws Exception
     */
    function is_current_domain(int $domain): bool {
        return session()->get('domain') === $domain;
    }
}

if(! function_exists('current_admin_route_has_name')) {
    /**
     * Use the snake case of the link name as the route name
     *
     * @param \Illuminate\Support\HtmlString|string $name
     * @return bool
     * @throws Exception
     */
    function current_admin_route_has_name($name): bool {
        if($name instanceof \Illuminate\Support\HtmlString) {
            $name = $name->toHtml();
        }

        if(! is_string($name)) {
            throw new Exception("Invalid route name");
        }

        return Route::currentRouteName() === Str::snake($name);
    }
}

if(! function_exists('page_title')) {

    /**
     * Get full page title
     *
     * @param $title
     * @return string
     */
    function page_title($title): string {
        return $title . ' | ' . config('app.name');
    }
}

if (!function_exists('lang_switcher')) {
    /**
     * Switch the language of the route
     *
     * @param string|null $language
     * @return string
     */
    function lang_switcher(string $language = null): string {
        if($language === null) {
            $language = config('app.fallback_locale');
        }
        $currentRoute = app('request')->route();
        $currentRouteName = $currentRoute->getName();
        $parameters = $currentRoute->parameters;

        return route($currentRouteName, $parameters);
    }
}
