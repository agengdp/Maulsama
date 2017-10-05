<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Media;

class NavMovieServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $movies = Media::where('type', 'movie')
                        ->latest()
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
