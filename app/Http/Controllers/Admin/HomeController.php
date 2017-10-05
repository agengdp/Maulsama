<?php

namespace App\Http\Controllers\Admin;

use App\Media;
use App\Episode;
use Illuminate\Http\Request;

class HomeController extends \App\Http\Controllers\Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = new Media;

        $series = $query->where('type', 'series')->take(10)->get();
        $movies = $query->where('type', 'movie')->take(10)->get();
        $last   = $query->take(5)->latest()->get();

        $episodes = Episode::take(10)->latest()->get();
        $episodesAll = Episode::all()->count();

        $data = [
            'media' => [
                'series'      => $series,
                'movies'      => $movies,
                'episodes'    => $episodes,
                'episodesAll' => $episodesAll,
                'last'        => $last
            ],
        ];

        return view('admin/dashboard', [
          'heading' => 'Dashboard',
          'data'    => $data
        ]);
    }
}
