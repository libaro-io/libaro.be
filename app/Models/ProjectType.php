<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class ProjectType extends Model
{
    protected $guarded = [];

    protected static function booted(): void
    {
        static::saving(function (ProjectType $projectType): void {
            if (blank($projectType->slug) && filled($projectType->getTranslatedName('nl'))) {
                $projectType->slug = Str::slug($projectType->getTranslatedName('nl'));
            }
        });
    }

    /**
     * @return HasMany<Project, $this>
     */
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
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
        ];
    }
}
