<?php

namespace App\Models;

use stdClass;
use Spatie\Tags\HasTags;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model implements HasMedia
{
    use HasFactory;
    use HasTags;
    use InteractsWithMedia;

    protected $guarded = [];

    protected $casts = [
        'publish_date' => 'date'
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('article_one')->withResponsiveImages();
        $this->addMediaCollection('article_two')->withResponsiveImages();
    }

    /**
     * Return the string path to this Article for the frontend
     *
     * @return string
     */
    public function getRouteAttribute(): string
    {
        return '/nl/blog/' . $this->slug;
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
