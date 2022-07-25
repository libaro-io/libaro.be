<?php

namespace App\Models;

use App\Scopes\OnlyVisibleScope;

class VisibleCompetence extends Competence
{
    protected $table = 'competences';

    /**
     * Do not return Competences which are marked as not visible
     */
    protected static function booted()
    {
        static::addGlobalScope(new OnlyVisibleScope);
    }
}
