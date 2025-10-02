<?php

namespace App\Models;

use App\Casts\AsTags;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property bool $visible
 * @property string $title
 * @property string $slug
 * @property string|null $description
 * @property string|null $image
 * @property string|null $author
 * @property \Illuminate\Support\Carbon|null $publish_date
 * @property string|null $link
 * @property mixed $tags
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BlogBlock> $blocks
 * @property-read int|null $blocks_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog wherePublishDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog whereVisible($value)
 * @mixin \Eloquent
 * @mixin IdeHelperBlog
 */
class Blog extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'visible' => 'boolean',
            'publish_date' => 'date',
            'tags' => AsTags::class,
        ];
    }

    public function blocks(): HasMany
    {
        return $this->hasMany(BlogBlock::class)->orderBy('sort');
    }
}
