<?php

namespace App\Models;

use App\Casts\AsTags;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'visible' => 'boolean',
            'tags' => AsTags::class,
        ];
    }
}
