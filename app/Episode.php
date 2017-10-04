<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    protected $table = 'episodes';

    use Sluggable;

    public function sluggable()
    {
        return [
        'slug' => [
          'source' => 'judul_episode'
        ]
      ];
    }

    public function series()
    {
        return $this->belongsTo('App\Media');
    }

    public function download_links()
    {
        return $this->hasMany('App\DownloadLink');
    }
}
