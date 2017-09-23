<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Series;

class NavSeriesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // $series = Series::latest()
        //                 ->take(5)
        //                 ->get();

        // \View::share('navSeries', $series);
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
