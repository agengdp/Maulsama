<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genre;
use App\Series;
use App\Episode;

class FrontSeriesController extends Controller
{
    public function index($slug)
    {
        $series = Series::where('slug', $slug)->first();

        return view('public.series', [
            'series'    => $series
        ]);
    }

    public function play($series_slug, $eps_slug)
    {
        $series   = Series::where('slug', $series_slug)->first();

        $episode  = Episode::where('series_id', $series->id)
                          ->where('slug', $eps_slug)
                          ->first();

        $videos = collect(json_decode($episode->links));

        foreach($videos as $stream){
          $stream->video_stream_id = substr($stream->video_url, strrpos($stream->video_url, '/') + 1); // Assign video id
          $stream->video_quality = rtrim($stream->video_quality, 'p');
        }
        
        $mp4_links = $videos->where('video_type', 'mp4');
        $mkv_links = $videos->where('video_type', 'mkv');

        return view('public.playEpisode', [
          'series'    => $series,
          'episode'   => $episode,
          'mp4_links' => $mp4_links->sortBy('video_quality'),
          'mkv_links' => $mkv_links->sortBy('video_quality')
      ]);
    }
}
