<?php

namespace App\Models;

use App\Casts\AsTags;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
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
