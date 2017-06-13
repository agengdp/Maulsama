<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genre;
use App\Series;
use App\Movie;

class FrontBrowseController extends Controller
{
    /**
     * Jumlah yang akan ditampilkan dalam browse
     * @var integer
     */
    private $taken = 18;

    /**
     * Digunakan untuk browse yang semua genre
     * @return view laravel
     */
    public function index(){
    	$genres = Genre::all();
    	$series = Series::paginate($this->taken);
    	$movies = Movie::paginate($this->taken);

    	return view('public/browse', [
    		'genres' => $genres,
    		'series' => $series,
    		'movies' => $movies
    	]);
    }

    /**
     * Digunakan untuk menampilkan series dan movie dalam genre tertentu
     * @param  string $genre slug dari genre
     * @return view          laravel
     */
    public function browse($genre){
        $genres = Genre::all();
        $series = Genre::where('slug', $genre)->first()->series()->paginate($this->taken);

        $movies = Genre::where('slug', $genre)->first()->movies()->paginate($this->taken);

        return view('public/browse', [
            'genres'    => $genres,
            'series'    => $series,
            'movies'    => $movies,
        ]);
    }
}
