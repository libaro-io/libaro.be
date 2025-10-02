<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $blog_id
 * @property string $type
 * @property array<array-key, mixed> $content
 * @property int $sort
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Blog $blog
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogBlock newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogBlock newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogBlock query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogBlock whereBlogId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogBlock whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogBlock whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogBlock whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogBlock whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogBlock whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogBlock whereUpdatedAt($value)
 * @mixin \Eloquent
 * @mixin IdeHelperBlogBlock
 */
class BlogBlock extends Model
{
    protected $guarded = [];

    protected $casts = [
        'content' => 'array',
    ];

    public function blog(): BelongsTo
    {
        return $this->belongsTo(Blog::class);
    }
}
