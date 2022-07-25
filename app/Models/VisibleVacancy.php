<?php

namespace App\Models;

use App\Scopes\OnlyVisibleScope;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VisibleVacancy extends Vacancy
{
    protected $table = 'vacancies';

    protected static function booted()
    {
        static::addGlobalScope(new OnlyVisibleScope);
    }

    /**
     * A Vacancy can have many Competences
     *
     * @return HasMany
     */
    public function competences(): HasMany
    {
        return $this
            ->hasMany(VisibleCompetence::class, 'vacancy_id', 'id')
            ->orderBy('number');
    }
}
