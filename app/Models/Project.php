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
}
