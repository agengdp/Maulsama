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

    public function media()
    {
        return $this->morphedByMany('App\Media', 'genreable');
    }
}
