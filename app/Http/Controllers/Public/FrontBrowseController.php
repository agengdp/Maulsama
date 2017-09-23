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
    private $taken = 12;

    /**
     * Digunakan untuk browse yang semua genre
     * @return view laravel
     */
    public function index(Request $request){

        $search = $request->input('s');
        $series = Series::search($search)->paginate($this->taken);
        $movies = Movie::search($search)->paginate($this->taken);

    	return view('public/browse', [
    		'series' => $series,
    		'movies' => $movies,
            's' => $search
    	]);
    }

    /**
     * Digunakan untuk menampilkan series dan movie dalam genre tertentu
     * @param  string $genre slug dari genre
     * @return view          laravel
     */
    public function browse($genre){
        
        $series = Genre::where('slug', $genre)->first()->series()->paginate($this->taken);
        $movies = Genre::where('slug', $genre)->first()->movies()->paginate($this->taken);

        return view('public/browse', [
            'series'    => $series,
            'movies'    => $movies,
        ]);
    }
}
