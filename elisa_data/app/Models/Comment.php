<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Comment extends Model
{
    protected function idea()
    {
        return $this->belongsTo('App\Models\Idea', 'idea_id');
    }

    protected $hidden = ['email'];
    protected $fillable = ['idea_id', 'name', 'title', 'content'];
    protected $table = 't_comment';
    protected $primaryKey = 'id';
}
