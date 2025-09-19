<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Client;

class Project extends Model
{
    protected $table = 'showcases';

    protected $guarded = [];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function content()
    {
        return $this->hasMany(ProjectContent::class, 'showcase_id');
    }

    public function blocks()
    {
        return $this->hasMany(ProjectBlock::class)->orderBy('sort');
    }
}
