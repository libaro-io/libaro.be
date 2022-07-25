<?php

namespace App\Models;

use App\Scopes\OnlyVisibleScope;

class VisibleArticle extends Article
{
    protected $table = 'articles';

    /**
     * Do not return Keys which are marked as not visible
     */
    protected static function booted()
    {
        static::addGlobalScope(new OnlyVisibleScope);
    }

}
