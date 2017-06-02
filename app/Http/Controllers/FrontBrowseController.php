<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genre;
class FrontBrowseController extends Controller
{
    public function index(){
    	$genres = Genre::all();
    	return view('public/browse', [
    		'genres' => $genres
    	]);
    }
}
