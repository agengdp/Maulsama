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

    public function scopeSearch($query, $s){
        return $query->where('title', 'like', '%' .$s. '%')
            ->orWhere('creator', 'like', '%'. $s .'%');
    }

    public function genre()
    {
        return $this->morphToMany('App\Genre', 'genreable');
    }

    public function episode()
    {
        return $this->hasMany('App\Episode');
    }

    // hanya untuk movies
    public function download_links()
    {
        return $this->hasMany('App\DownloadLink');
    }

    // hanya untuk episode
    public static function boot()
    {
        parent::boot();

        static::deleting(function ($episode) {
            
            Storage::delete('public/'.$episode->cover); // hapus cover sendiri

            if (count($episode->episode)) { // cek jika ada episode nya
                foreach ($episode->episode as $kampret) {
                    $arr[] = 'public/'.$kampret->cover;
                }
                Storage::delete($arr); // hapus cover yang ada di episode juga
            }
            $episode->episode()->delete();
        });
    }
}
