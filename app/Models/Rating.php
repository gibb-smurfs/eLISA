<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Rating extends Model
{
    protected function idea()
    {
        return $this->belongsTo('App\Models\Idea', 'idea_id');
    }

    protected $table = 't_rating';
    protected $primaryKey = 'id';
}
