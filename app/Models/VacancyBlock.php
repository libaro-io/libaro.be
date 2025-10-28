<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperVacancyBlock
 */
class VacancyBlock extends Model
{
    protected $guarded = [];

    protected $casts = [
        'content' => 'array',
    ];

    /**
     * @return BelongsTo<Vacancy, $this>
     */
    public function blog(): BelongsTo
    {
        return $this->belongsTo(Vacancy::class);
    }
}
