<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Genre extends Model
{
    protected $table = 'genres';
    protected $fillable = ['name'];

    public $timestamps = false;

    use Sluggable;

    public function sluggable()
    {
        return [
        'slug' => [
          'source' => 'name'
        ]
      ];
    }

    public function series()
    {
        return $this->morphedByMany('App\Series', 'genreable');
    }

    public function movies()
    {
        return $this->morphedByMany('App\Movie', 'genreable');
    }

}
