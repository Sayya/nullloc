<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    public function post()
    {
        return $this->belongsTo('App\Post');
    }
}
