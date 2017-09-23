<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DownloadLink extends Model
{
    protected $table = 'download_links';

    public function episode(){
    	return $this->belongsTo('App\Episode');
    }

    public function movie(){
    	$this->belongsTo('App\Movie');
    }
}
