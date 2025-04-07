<?php

namespace App\Models;

use App\ValueObjects\Domains;
use App\ValueObjects\MenuType;
use App\Scopes\OnlyVisibleScope;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NavigationItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function booted()
    {
        static::addGlobalScope(new OnlyVisibleScope);

        static::addGlobalScope('order', function (Builder $builder) {
           $builder->orderBy('order');
        });
    }

    /**
     * Get a cached version of all NavigationItems.
     * Of type main.
     *
     * @return Collection
     */
    public static function main(): Collection
    {
        return Cache::rememberForever('menu_main', function () {
            return self::where('menu', MenuType::MAIN)->get();
        });
    }

    /**
     * Get a cached version of all NavigationItems.
     * Of type secondary.
     *
     * @return Collection
     */
    public static function secondary(): Collection
    {
        return Cache::rememberForever('menu_secondary', function () {
            $items =  self::query()
                ->where('menu', '=', MenuType::SECONDARY)
                ->get()
                ->filter(function ($item) {
                    if ($item->domain !== Domains::VACANCIES) {
                        return $item;
                    }
                    if (Vacancy::query()->where('visible', '=', '1')->count()) {
                        return $item;
                    }
                    return false;
                });
            return $items;
        });
    }
}
