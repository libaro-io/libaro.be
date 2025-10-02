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
     * @return HasMany<Competence, $this>
     */
    public function competencies(): HasMany
    {
        return $this->hasMany(Competence::class);
    }
}
