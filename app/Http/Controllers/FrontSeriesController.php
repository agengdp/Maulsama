<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genre;
use App\Series;

class FrontSeriesController extends Controller
{
    public function index($slug){
    	$genres = Genre::all();
    	$series = Series::find($slug);

    	return view('public.series', [
    		'genres'	=> $genres,
    		'series'	=> $series
    	]);
    }
}
