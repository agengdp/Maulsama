<?php

namespace App\Http\Controllers\Admin;
use App\Media;

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

        $series = $query->where('type', 'series')->get();
        $movies = $query->where('type', 'movies')->get();
        $last = $query->take(5)->latest()->get();

        $data = (object) [
            'title' => 'Dashboard',
            'media' => [
                'series'    => $series,
                'movies'    => $movies,
                'last'      => $last
            ],
        ];

        return view('admin/home', [
          'data' => $data
        ]);
    }
}
