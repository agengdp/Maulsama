<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genre;
use App\Media;
use App\Episode;
use App\Page;

class FrontController extends Controller
{

    /**
     * Jumlah yang akan ditampilkan dalam browse
     * @var integer
     */
    private $taken = 8;

    /**
     * Halaman index / home
     * @return view laravel
     */
    public function index()
    {
        $series       = Media::where('type', 'series')->latest()->take(6)->get();
        $episodes     = Episode::latest()->take($this->taken)->get();

        return view('public/index', [
            'series'      => $series,
            'episodes'    => $episodes
        ]);
    }

    /**
     * Digunakan untuk browse yang semua genre
     * @return view laravel
     */
    public function browse(Request $request)
    {
        $search = $request->input('s');

        $media = new Media();
        $series = $media->where('type', 'series')->search($search)->latest()->paginate($this->taken);
        $movies = $media->where('type', 'movie')->search($search)->latest()->paginate($this->taken);

        $title = 'Jelajahi Koleksi Anime Sub Indo Terlengkap';

        if (!empty($search)) {
            $title = "Hasil Pencarian Untuk : $search";
        }

        return view('public/browse', [
            'browse_title'  => $title,
            'series'        => $series,
            'movies'        => $movies,
            's'             => $search
        ]);
    }

    /**
     * Digunakan untuk menampilkan series dan movie dalam genre tertentu
     * @param  string $genre slug dari genre
     * @return view          laravel
     */
    public function browseGenre($genre)
    {
        $series = Genre::where('slug', $genre)->first()->media()->latest()->where('type', 'series')->paginate($this->taken);
        $movies = Genre::where('slug', $genre)->first()->media()->latest()->where('type', 'movie')->paginate($this->taken);

        return view('public/browse', [
            'browse_title'  => 'Anime Genre : '. Genre::where('slug', $genre)->first()->name,
            'series'        => $series,
            'movies'        => $movies,
        ]);
    }

    /**
     * Display series
     * @param  string $slug [description]
     * @return view       [description]
     */
    public function series($slug)
    {
        $series = Media::where([
          ['slug', '=', $slug],
          ['type', '=', 'series'],
        ])->first();

        // error 404 handle
        if (is_null($series)) {
            abort(404);
        }

        return view('public.series', [
          'series'    => $series
      ]);
    }

    /**
     * Play Episode
     * @param  string $series_slug [description]
     * @param  string $eps_slug    [description]
     * @return view              [description]
     */
    public function playEpisode($series_slug, $eps_slug)
    {
        $series   = Media::where('slug', $series_slug)->first();

        // error 404 handle
        if (is_null($series)) {
            abort(404);
        }

        $episode  = Episode::where('series_id', $series->id)
                        ->where('slug', $eps_slug)
                        ->first();

        // error 404 handle
        if (is_null($episode)) {
            abort(404);
        }

        $videos = $episode->download_links;
        $streams = [];
        foreach ($videos->where('video_type', 'mp4') as $stream) {
            $streams[]  = [
            'quality'   => $stream->video_quality,
            'url_id'    => substr($stream->video_url, strrpos($stream->video_url, '/') + 1), // Assign video id
          ];
        }
        $collection = collect($streams);

        return view('public.playEpisode', [
          'series'        => $series,
          'episode'       => $episode,
          'streams'       => $collection,
          'mp4_links'     => $videos->where('video_type', 'mp4'),
          'mkv_links'     => $videos->where('video_type', 'mkv'),
      ]);
    }

    /**
     * Play Movie
     * @param  string $slug Movie slug
     * @return view
     */
    public function movie($slug)
    {
        $movie = Media::where([
          ['slug', '=', $slug],
          ['type', '=', 'movie'],
        ])->first();
        // error 404 handle
        if (is_null($movie)) {
            abort(404);
        }

        $videos = $movie->download_links;
        $streams = [];
        foreach ($videos->where('video_type', 'mp4') as $stream) {
            $streams[]  = [
            'quality'   => $stream->video_quality,
            'url_id'    => substr($stream->video_url, strrpos($stream->video_url, '/') + 1), // Assign video id
          ];
        }

        $collection = collect($streams);

        return view('public.playMovie', [
            'movie'         => $movie,
            'streams'       => $collection,
            'mp4_links'     => $videos->where('video_type', 'mp4'),
            'mkv_links'     => $videos->where('video_type', 'mkv'),
          ]);
    }

    /**
     * Menampilkan pages
     * @param  string $page slug nya pages
     * @return view laravel
     */
    public function page($page)
    {
        $page = Page::where('slug', $page)->first();

        if (is_null($page)) {
            abort(404);
        }

        return view('public.page', [
          'page'  => $page
        ]);
    }
}
