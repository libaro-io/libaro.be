<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Key extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * A Key belongs to a Showcase
     *
     * @return BelongsTo
     */
    public function showcase(): BelongsTo
    {
        return $this->belongsTo(Showcase::class);
    }
}
