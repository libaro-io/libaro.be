<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
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

            $project->syncTypeTag();
        });
    }

    public function syncTypeTag(): void
    {
        if (! $this->project_type_id) {
            return;
        }

        $type = $this->projectType ?? ProjectType::find($this->project_type_id);
        if (! $type) {
            return;
        }

        $allTypeSlugs = ProjectType::pluck('slug')->all();
        $oldTypeTagIds = Tag::query()
            ->where(function ($query) use ($allTypeSlugs): void {
                foreach ($allTypeSlugs as $slug) {
                    $query->orWhere('slug->nl', $slug);
                }
            })
            ->pluck('id')
            ->all();

        $this->tags()->detach($oldTypeTagIds);

        $newTypeTag = Tag::where('slug->nl', $type->slug)->first();
        if ($newTypeTag) {
            $this->tags()->syncWithoutDetaching([$newTypeTag->id]);
        }
    }

    /**
     * @return BelongsTo<Client, $this>
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * @return BelongsTo<ProjectType, $this>
     */
    public function projectType(): BelongsTo
    {
        return $this->belongsTo(ProjectType::class);
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
     * @return MorphToMany<\App\Models\Tag, $this>
     */
    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
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
            'carousel_images' => 'array',
        ];
    }
}
