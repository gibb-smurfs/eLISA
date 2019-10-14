<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Idea extends Model
{
    public function ratings()
    {
        return $this->hasMany('App\Models\Rating', 'idea_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'idea_id');
    }

    protected $table = 't_idea';
    protected $primaryKey = 'id';
}
