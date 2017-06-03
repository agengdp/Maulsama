<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Movie extends Model
{
    protected $table    = 'movies';

    use Sluggable;

    public function sluggable()
    {
        return [
        'slug' => [
          'source' => 'title'
        ]
      ];
    }
    
    public function genre()
    {
        return $this->morphToMany('App\Genre', 'genreable');
    }
}
