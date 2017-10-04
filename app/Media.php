<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;
use Cviebrock\EloquentSluggable\Sluggable;

class Media extends Model
{
    protected $table = 'media';

    use Sluggable;

    public function sluggable()
    {
        return [
        'slug' => [
          'source' => 'title'
        ]
      ];
    }

    public function scopeSearch($query, $s)
    {
        return $query->where('title', 'like', '%' .$s. '%')
            ->orWhere('creator', 'like', '%'. $s .'%');
    }

    public function genre()
    {
        return $this->morphToMany('App\Genre', 'genreable');
    }

    public function episode()
    {
        return $this->hasMany('App\Episode', 'series_id');
    }

    // hanya untuk movies
    public function download_links()
    {
        return $this->hasMany('App\DownloadLink', 'rel_id');
    }

    // hanya untuk episode
    public static function boot()
    {
        parent::boot();

        static::deleting(function ($episode) {

            // hapus cover dari series
            if (Storage::disk(env('FILE_SYSTEM'))->has('public/'. $episode->cover)) {
                Storage::delete('public/'.$episode->cover); // hapus covernya sendiri
            }

            if (count($episode->episode)) { // cek jika ada episode nya
                foreach ($episode->episode as $kampret) {
                    $kampret->download_links()->delete(); // hapus download link yang tersisa
                    $arr[] = 'public/'.$kampret->cover;
                }
                Storage::delete($arr); // hapus cover yang ada di episode juga
            }
            $episode->episode()->delete();
        });
    }
}
