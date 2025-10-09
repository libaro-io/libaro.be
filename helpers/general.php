<?php

if (! function_exists('alternative_locales')) {
    function alternative_locales(string $locale): array
    {
        return array_diff(config('app.supported_locales'), [$locale]);
    }
}
