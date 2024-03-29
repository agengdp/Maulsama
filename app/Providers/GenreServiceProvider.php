<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Genre;

class GenreServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $genres = Genre::all();
        if(!empty($genres)){
            \View::share('genres', Genre::all());
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
