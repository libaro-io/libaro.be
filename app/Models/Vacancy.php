<?php

namespace App\Models;

use stdClass;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Tags\HasTags;

class Vacancy extends Model implements HasMedia
{
    use HasFactory;
    use HasTags;
    use InteractsWithMedia;

    protected $guarded = [];

    protected $appends = ['route'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('vacancy')->withResponsiveImages();
    }

    /**
     * A Vacancy can have many Competences
     *
     * @return HasMany
     */
    public function competences(): HasMany
    {
        return $this->hasMany(Competence::class)->orderBy('number');
    }

    /**
     * Return the string path to this Vacancy for the frontend
     *
     * @return string
     */
    public function getRouteAttribute(): string
    {
        return '/nl/jobs/' . $this->slug;
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
