<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Conner\Tagging\Taggable;

class Genre extends Model
{
    protected $table = 'genres';
    protected $fillable = ['name'];

    public $timestamps = false;

    public function series()
    {
        return $this->morphedByMany('App\Series', 'genreable');
    }

    public function movies(){
    	return $this->morphedByMany('App\Movie', 'genreable');
    }
}
