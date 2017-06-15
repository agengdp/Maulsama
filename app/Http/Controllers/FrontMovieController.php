<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;

class FrontMovieController extends Controller
{
    public function index($slug){

    	$movie = Movie::where('slug', $slug)->first();
        
        $videos = collect(json_decode($movie->links));
    	
    	foreach($videos as $stream){
          $stream->video_stream_id = substr($stream->video_url, strrpos($stream->video_url, '/') + 1); // Assign video id
          $stream->video_quality = rtrim($stream->video_quality, 'p');
        }
        
        $mp4_links = $videos->where('video_type', 'mp4');
        $mkv_links = $videos->where('video_type', 'mkv');

    	return view('public.playMovie', [
    		'movie' => $movie,
	        'mp4_links' => $mp4_links->sortBy('video_quality'),
	        'mkv_links' => $mkv_links->sortBy('video_quality')
    	]);
    }
}
