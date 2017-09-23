<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Episode;

class NavOngoingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // $episodes = Episode::latest()
        //                     ->take(5)
        //                     ->get();

        // \View::share('navOngoing', $episodes);
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
