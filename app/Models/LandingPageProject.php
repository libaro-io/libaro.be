<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $project_id
 * @property int $landing_page_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPageProject newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPageProject newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPageProject query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPageProject whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPageProject whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPageProject whereLandingPageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPageProject whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPageProject whereUpdatedAt($value)
 * @mixin \Eloquent
 * @mixin IdeHelperLandingPageProject
 */
class LandingPageProject extends Model
{
    protected $table = 'landing_page_project';
}
