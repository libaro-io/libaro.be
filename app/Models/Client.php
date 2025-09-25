<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $guarded = [];

    protected $table = 'clients';

    public function projects()
    {
        return $this->hasMany(Project::class, 'client_id', 'id');
    }
}
