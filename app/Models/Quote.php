<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quote extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $guarded = [];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('quote')->withResponsiveImages();
    }

    /**
     * A Quote belongs to a Showcase
     *
     * @return BelongsTo
     */
    public function showcase(): BelongsTo
    {
        return $this->belongsTo(Showcase::class);
    }
}
