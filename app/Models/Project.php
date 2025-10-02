<?php

namespace App\Models;

use App\Casts\AsTags;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @property int $id
 * @property bool $visible
 * @property bool $is_product
 * @property string $name
 * @property string $description
 * @property string|null $image
 * @property string|null $client_url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $slug
 * @property string $type
 * @property int|null $client_id
 * @property string|null $date
 * @property int $pin_on_homepage
 * @property mixed $tags
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProjectBlock> $blocks
 * @property-read int|null $blocks_count
 * @property-read \App\Models\Client|null $client
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProjectContent> $content
 * @property-read int|null $content_count
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereClientUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereIsProduct($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project wherePinOnHomepage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereVisible($value)
 * @mixin \Eloquent
 * @mixin IdeHelperProject
 */
class Project extends Model
{
    use InteractsWithMedia;
    protected $table = 'projects';

    protected $guarded = [];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function content(): HasMany
    {
        return $this->hasMany(ProjectContent::class, 'showcase_id');
    }

    public function blocks(): HasMany
    {
        return $this->hasMany(ProjectBlock::class)->orderBy('sort');
    }

    protected function casts(): array
    {
        return [
            'visible' => 'boolean',
            'is_product' => 'boolean',
            'tags' => AsTags::class
        ];
    }
}
