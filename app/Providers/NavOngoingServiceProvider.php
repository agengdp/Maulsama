<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Episode;
use App\Media;

class NavOngoingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        $ongoing = Media::with('episode')->where('status', 'ongoing')->latest()->get();
        \View::share('navOngoing', $ongoing);
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
