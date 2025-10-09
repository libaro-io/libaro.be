<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @mixin IdeHelperLandingPage
 */
class LandingPage extends Model
{
    protected $table = 'landing_pages';

    /**
     * @return BelongsToMany<Project, $this>
     */
    public function projects(): BelongsToMany
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
            'updated_at' => 'datetime',
        ];
    }
}
