<?php

namespace App\Models;

use App\Scopes\OnlyVisibleScope;

class VisibleClient extends Client
{
    protected $table = 'clients';

    /**
     * Do not return Competences which are marked as not visible
     */
    protected static function booted()
    {
        static::addGlobalScope(new OnlyVisibleScope);
    }

    public function showcases()
    {
        return $this->hasMany(VisibleShowcase::class, 'client_id', 'id');
    }
}
