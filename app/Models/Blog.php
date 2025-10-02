<?php

namespace App\Models;

use App\Casts\AsTags;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    protected function casts(): array
    {
        return [
            'visible' => 'boolean',
            'publish_date' => 'date',
            'tags' => AsTags::class,
        ];
    }
}
