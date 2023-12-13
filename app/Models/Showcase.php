<?php

namespace App\Models;

use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;
use stdClass;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Tags\HasTags;

class Showcase extends Model implements HasMedia, Sitemapable
{
    use HasFactory;
    use HasTags;
    use InteractsWithMedia;

    protected $guarded = [ ];

    protected $casts = [
        'date' => 'date',
    ];

    protected $appends = ['route'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('showcase_card')->withResponsiveImages();
        $this->addMediaCollection('showcase_header')->withResponsiveImages();
        $this->addMediaCollection('showcase_extra')->withResponsiveImages();
        $this->addMediaCollection('showcase_logo')->withResponsiveImages();
    }

    public function toSitemapTag(): Url | string | array
    {
        return '/nl/realisaties/'. $this->slug;
    }


    /**
     * A Showcase belongs to a Client
     *
     * @return BelongsTo
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * All Keys, excluding those marked as not visible
     *
     * @return HasMany
     */
    public function keys(): HasMany
    {
        return $this->hasMany(Key::class)->orderBy('number');
    }

    /**
     * All Quotes, excluding those marked as not visible
     *
     * @return HasMany
     */
    public function quotes(): HasMany
    {
        return $this->hasMany(Quote::class);
    }

    /**
     * Does this Showcase has any attached quotes
     *
     * @return bool
     */
    public function hasQuotes(): bool
    {
        return $this->quotes()->count() > 0;
    }

    /**
     * Return the string path to this Showcase for the frontend
     *
     * @return string
     */
    public function getRouteAttribute(): string
    {
        return '/nl/realisaties/' . $this->slug;
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getMappedTags()
    {
        $coll = collect();
        foreach ($this->tags as $tag) {
            $arr = $tag->toArray();
            $obj = new stdClass();

            $name = $arr['name'];
            $slug = $arr['slug'];

            if(array_key_exists('en', $name)) {
                $obj->name = $name['en'];
                $obj->slug = $slug['en'];

                $coll->add($obj);
            } elseif (array_key_exists('nl', $name)) {
                $obj->name = $name['nl'];
                $obj->slug = $slug['nl'];

                $coll->add($obj);
            }
        }

        return $coll;
    }
}
