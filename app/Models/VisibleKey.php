<?php

namespace App\Models;

use App\Scopes\OnlyVisibleScope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VisibleKey extends Key
{
    protected $table = 'keys';

    /**
     * Do not return Keys which are marked as not visible
     */
    protected static function booted()
    {
        static::addGlobalScope(new OnlyVisibleScope);
    }

    /**
     * A Key belongs to a Showcase
     *
     * @return BelongsTo
     */
    public function showcase(): BelongsTo
    {
        return $this->belongsTo(VisibleShowcase::class);
    }
}
