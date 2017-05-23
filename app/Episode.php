<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    protected $table = 'episodes';

    public function series()
    {
        return $this->belongsTo('App\Series');
    }
}
