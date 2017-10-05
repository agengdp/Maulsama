<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Media;

class NavSeriesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $series = Media::where('type', 'series')
                        ->latest()
                        ->take(5)
                        ->get();

        \View::share('navSeries', $series);
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
