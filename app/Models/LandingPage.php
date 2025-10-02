<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $skill
 * @property string $target
 * @property string $location
 * @property int|null $image_index
 * @property string|null $title
 * @property string|null $text1
 * @property string|null $text2
 * @property string|null $text3
 * @property string $slug
 * @property bool $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Project> $projects
 * @property-read int|null $projects_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPage query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPage whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPage whereImageIndex($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPage whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPage whereSkill($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPage whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPage whereTarget($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPage whereText1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPage whereText2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPage whereText3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPage whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandingPage whereUpdatedAt($value)
 * @mixin \Eloquent
 * @mixin IdeHelperLandingPage
 */
class LandingPage extends Model
{
    protected $table = 'landing_pages';

    public function projects()
    {
        return $this->belongsToMany(
            Project::class,
            LandingPageProject::class,
            'landing_page_id',
            'project_id'
        );
    }

    protected function casts(): array
    {
        return [
            'active' => 'boolean',
        ];
    }
}
