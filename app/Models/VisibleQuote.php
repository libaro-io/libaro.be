<?php

namespace App\Models;

use App\Scopes\OnlyVisibleScope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VisibleQuote extends Quote
{
    protected $table = 'quotes';

    /**
     * Do not return Quotes which are marked as not visible
     */
    protected static function booted()
    {
        static::addGlobalScope(new OnlyVisibleScope);
    }

    /**
     * A Quote belongs to a Showcase
     *
     * @return BelongsTo
     */
    public function showcase(): BelongsTo
    {
        return $this->belongsTo(VisibleShowcase::class);
    }
}
