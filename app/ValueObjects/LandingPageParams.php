<?php

namespace App\ValueObjects;

use Illuminate\Support\Collection;

class LandingPageParams
{

    private static $langKey = 'landing-pages';

    public static function skills(): Collection
    {
        $category = 'skill';
        return collect([
            'Ibanity integraties',
            'energie facturatie',
            'gebouw automatisatie',
            'ticketing platformen',
            'planningsoftware op maat',
            'kiosk apps',
            'iOT software',
            'digital signage',
            'reservatie systemen',
            'scherm aansturing',
            'facturatie tools',
            '3D configurators',
            'bestelplatformen',
            'bpost integraties',
        ]);
    }

    public static function targets(): Collection
    {
        $category = 'target';
        return collect([
            self::trans($category, 'bedrijven'),
//            self::trans($category, 'kastenbouwers'),
//            self::trans($category, 'gebouwbeheerders'),
        ]);
    }

    public static function locations(): Collection
    {
        $category = 'location';
        return collect([
            self::trans($category, 'brugge'),
            self::trans($category, 'gent'),
            self::trans($category, 'kortrijk'),
            self::trans($category, 'roeselare'),
            self::trans($category, 'west-vlaanderen'),
            self::trans($category, 'oost-vlaanderen'),
        ]);
    }

    public static function title(): string
    {
        $category = 'title';

        return self::trans($category, 'title');
    }

    public static function AITitle(): string
    {
        $category = 'title';

        return self::trans($category, 'ai_title');
    }

    public static function subTitle(): string
    {
        $category = 'title';

        return self::trans($category, 'subtitle');
    }

    private static function trans($category, $key)
    {
        return trans(self::$langKey . '.' . $category . '.' . $key);
    }
}
