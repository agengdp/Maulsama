<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $table 	= 'movies';

    public function genre()
    {
        return $this->morphToMany('App\Genre', 'genreable');
    }
}
