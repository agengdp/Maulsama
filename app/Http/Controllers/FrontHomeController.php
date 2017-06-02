<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genre;
use App\Series;
use App\Episode;

class FrontHomeController extends Controller
{
    public function index(){

    	$genres 	= Genre::all();
    	$series 	= Series::take(6)->get();

    	$episodes 	= Episode::orderBy('created_at', 'desc')->take(12)->get();
    	
    	return view('public/index', [
    		'genres' 	=> $genres,
    		'series' 	=> $series,
    		'episodes'	=> $episodes
    	]);
    }
}
