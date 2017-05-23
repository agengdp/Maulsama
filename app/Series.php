<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    protected $table = 'series';

    public function genre()
    {
        return $this->morphToMany('App\Genre', 'genreable');
    }

    public function episodes()
    {
        return $this->belongsToMany('App\Episode');
    }
}
