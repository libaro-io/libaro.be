<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $showcase_id
 * @property int $visible
 * @property int $number
 * @property string $title
 * @property string $body
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectContent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectContent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectContent query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectContent whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectContent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectContent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectContent whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectContent whereShowcaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectContent whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectContent whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectContent whereVisible($value)
 * @mixin \Eloquent
 * @mixin IdeHelperProjectContent
 */
class ProjectContent extends Model
{
    protected $guarded = [];
}
