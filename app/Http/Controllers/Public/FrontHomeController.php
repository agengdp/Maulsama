<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genre;
use App\Series;
use App\Episode;

class FrontHomeController extends Controller
{
    public function index(){

    	$series 	= Series::latest()->take(6)->get();

    	$episodes 	= Episode::latest()->take(12)->get();
    	
    	return view('public/index', [
    		'series' 	=> $series,
    		'episodes'	=> $episodes
    	]);
    }
}
