<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
