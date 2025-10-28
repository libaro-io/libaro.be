<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin IdeHelperVacancy
 */
class Vacancy extends Model
{
    protected $guarded = [];

    /**
     * @return HasMany<VacancyBlock, $this>
     */
    public function blocks(): HasMany
    {
        return $this->hasMany(VacancyBlock::class)->orderBy('sort');
    }
}
