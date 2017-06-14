<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Movie;

class NavMovieServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $movies = Movie::orderBy('created_at', 'desc')
                            ->take(5)
                            ->get();

        \View::share('navMovies', $movies);        
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
