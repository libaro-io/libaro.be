<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $project_id
 * @property string $type
 * @property array<array-key, mixed> $content
 * @property int $sort
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Project $project
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectBlock newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectBlock newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectBlock query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectBlock whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectBlock whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectBlock whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectBlock whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectBlock whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectBlock whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectBlock whereUpdatedAt($value)
 * @mixin \Eloquent
 * @mixin IdeHelperProjectBlock
 */
class ProjectBlock extends Model
{
    protected $guarded = [];

    protected $casts = [
        'content' => 'array',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
