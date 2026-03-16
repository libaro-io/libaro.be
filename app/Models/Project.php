<?php

namespace App\Models;

use App\Casts\AsTags;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\ResponseCache\Facades\ResponseCache;

/**
 * @mixin IdeHelperProject
 */
class Project extends Model
{
    use InteractsWithMedia;
    protected $table = 'projects';

    protected $guarded = [];

    protected static function booted(): void
    {
        static::saved(function (Project $project): void {
            if (! config('responsecache.enabled', true)) {
                return;
            }
            $slug = $project->slug;
            $locales = config('app.supported_locales', ['nl', 'en']);
            $detailUris = array_map(
                fn (string $locale) => "/{$locale}/realisaties/{$slug}",
                $locales
            );
            $listUris = array_map(
                fn (string $locale) => "/{$locale}/realisaties",
                $locales
            );
            ResponseCache::forget(array_merge($detailUris, $listUris));
        });
    }

    /**
     * @return BelongsTo<Client, $this>
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * @return HasMany<ProjectContent, $this>
     */
    public function content(): HasMany
    {
        return $this->hasMany(ProjectContent::class, 'showcase_id');
    }

    /**
     * @return HasMany<ProjectBlock, $this>
     */
    public function blocks(): HasMany
    {
        return $this->hasMany(ProjectBlock::class)->orderBy('sort');
    }

    /**
     * @return Attribute<string, string>
     */
    protected function slug(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Str::lower($value),
            set: fn (string $value) => $value,
        );
    }

    protected function casts(): array
    {
        return [
            'visible' => 'boolean',
            'is_product' => 'boolean',
            'updated_at' => 'datetime',
            'tags' => AsTags::class,
            'carousel_images' => 'array',
        ];
    }
}
