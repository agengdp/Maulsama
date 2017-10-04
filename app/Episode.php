<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Storage;
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
        return $this->hasMany('App\DownloadLink', 'rel_id');
    }

    protected static function boot()
    {
        parent::boot();

        // hapus download link
        // karena ada dalam model yang berbeda
        // untuk penghapusan covernya, sudah di handle di dalam model Media.
        //
        static::deleting(function ($download_link) {
            // cek jika punya cover
            if (Storage::disk(env('FILE_SYSTEM'))->has('public/'. $download_link->cover)) {
                Storage::delete('public/'.$download_link->cover); // hapus covernya sendiri
            }
            $download_link->download_links()->delete();
        });
    }
}
