<?php

namespace App\Models;

use App\Casts\AsTags;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
