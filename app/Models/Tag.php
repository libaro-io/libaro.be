<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Str;

/**
 * @property array<string, string> $name
 * @property array<string, string> $slug
 */
class Tag extends Model
{
    protected $guarded = [];

    public static function booted(): void
    {
        static::saving(function (Tag $tag): void {
            /** @var array<string, string>|mixed $name */
            $name = $tag->name;
            if (is_array($name)) {
                $tag->slug = array_map(fn (string $v) => Str::slug($v), $name);
            }
        });
    }

    /**
     * @return MorphToMany<Project, $this>
     */
    public function projects(): MorphToMany
    {
        return $this->morphedByMany(Project::class, 'taggable');
    }

    /**
     * @return MorphToMany<Blog, $this>
     */
    public function blogs(): MorphToMany
    {
        return $this->morphedByMany(Blog::class, 'taggable');
    }

    public function getTranslatedName(?string $locale = null): string
    {
        $locale ??= app()->getLocale();
        /** @var array<string, string> $name */
        $name = $this->name;

        return $name[$locale] ?? $name['nl'] ?? '';
    }

    protected function casts(): array
    {
        return [
            'name' => 'array',
            'slug' => 'array',
        ];
    }
}
