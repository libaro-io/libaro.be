<?php

namespace App\Models;

use App\Scopes\OnlyVisibleScope;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VisibleShowcase extends Showcase
{

    protected $table = 'showcases';
    /**
     * Do not return Showcases which are marked as not visible
     */
    protected static function booted()
    {
        static::addGlobalScope(new OnlyVisibleScope);
    }

    /**
     * All Keys, excluding those marked as not visible
     *
     * @return HasMany
     */
    public function keys(): HasMany
    {
        return $this->hasMany(VisibleKey::class,'showcase_id', 'id');
    }

    /**
     * All Quotes, excluding those marked as not visible
     *
     * @return HasMany
     */
    public function quotes(): HasMany
    {
        return $this->hasMany(VisibleQuote::class, 'showcase_id', 'id');
    }

    /**
     * Does this Showcase has any attached quotes, which are marked as visible
     *
     * @return bool
     */
    public function hasQuotes(): bool
    {
        return $this->quotes()->count() > 0;
    }
}
