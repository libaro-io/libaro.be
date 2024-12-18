<?php

namespace App\ValueObjects;

use Illuminate\Support\Collection;

class WebRoutes
{
    public const SERVICES = ['nl' => 'diensten', 'en' => 'services'];
    public const SERVICES_WEB = ['nl' => '/diensten/web-ontwikkeling', 'en' => 'services/web'];
    public const SERVICES_APP = ['nl' => 'diensten/apps', 'en' => 'services/apps'];
    public const SERVICES_ARCHITECTURE = ['nl' => 'diensten/digitale-architectuur', 'en' => 'services/digital-architecture'];
    public const SERVICES_AI = ['nl' => 'diensten/artificiële-intelligentie', 'en' => 'services/artificial-intelligence'];
    public const SERVICES_IOT = ['nl' => 'diensten/internet-of-things', 'en' => 'services/internet-of-things'];
    public const ABOUT_US = ['nl' => 'over-ons', 'en' => 'about-us'];

    public static function translatedRoutes(): Collection
    {
        return collect([
            self::SERVICES,
            self::SERVICES_WEB,
            self::SERVICES_APP,
            self::SERVICES_ARCHITECTURE,
            self::SERVICES_AI,
            self::SERVICES_IOT,
            self::ABOUT_US,
        ]);
    }

    public static function getTranslatedRoute($path)
    {
            $found = false;
        foreach (self::translatedRoutes() as $route) {
            foreach ($route as $arrayPathKey => $arrayPathValue) {
                if($arrayPathValue === $path) {
                    $found = "$arrayPathKey/$arrayPathValue";
                }
            }
        }
            return $found;
    }
}
