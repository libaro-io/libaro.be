<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * @mixin IdeHelperBlog
 */
class Blog extends Model
{
    protected $guarded = [];

    /**
     * @return HasMany<BlogBlock, $this>
     */
    public function blocks(): HasMany
    {
        return $this->hasMany(BlogBlock::class)->orderBy('sort');
    }

    /**
     * @return MorphToMany<Tag, $this>
     */
    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    protected function casts(): array
    {
        return [
            'visible' => 'boolean',
            'publish_date' => 'date',
            'updated_at' => 'datetime',
        ];
    }
}
