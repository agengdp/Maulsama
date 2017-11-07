<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genre;
use App\Media;
use App\Episode;
use App\Page;
use SEO;

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

        SEO::setTitle('Maulsama - Tempat Download Anime Sub Indonesia Terlengkap');
        SEO::setDescription('Maulsama adalah tempat untuk nonton / streaming dan download anime terlengkap dan terupdate');
        SEO::metatags()->setKeywords('anime, download, movie');
        SEO::addImages([
          route('image.logo', [
            'name' => 'logo',
            'width' => 615
          ])
        ]);

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
        $desc  = 'Jelajahi seluruh koleksi anime sub Indonesia di Maulsama.com';

        if (!empty($search)) {
            $title = "Hasil Pencarian Untuk : $search";
            $desc = "Hasil pencarian anime $search sub Indonesia, download $search sub Indonesia";
        }

        SEO::setTitle($title);
        SEO::setDescription($desc);
        SEO::metatags()->setKeywords('anime, download, movie, koleksi');

        return view('public/browse', [
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

        SEO::setTitle('Anime Genre : '. Genre::where('slug', $genre)->first()->name);
        SEO::setDescription('Koleksi genre '.Genre::where('slug', $genre)->first()->name.' anime series dan movie Sub Indonesia. Download anime dengan genre '. Genre::where('slug', $genre)->first()->name);
        SEO::metatags()->setKeywords('anime, download, movie, nonton, ' .Genre::where('slug', $genre)->first()->name);

        return view('public/browse', [
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

        SEO::setTitle($series->title);
        SEO::setDescription("Download Anime $series->title Subtitle Indonesia.");
        SEO::metatags()->setKeywords($series->title);
        SEO::addImages([
          route('image.og', ['name' => $series->cover])
        ]);

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


        SEO::setTitle("$series->title Episode $episode->episode - $episode->judul_episode");
        SEO::setDescription("Download $series->title Episode $episode->episode - $episode->judul_episode Anime Subtitle Indonesia.");
        SEO::metatags()->setKeywords("$series->title, $series->title episode $episode->episode, $episode->judul_episode");
        SEO::addImages([
          route('image.og', ['name' => $episode->cover])
        ]);

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


        SEO::setTitle("Download $movie->title Subtitle Indonesia");
        SEO::setDescription("Download $movie->title Anime Subtitle Indonesia. Nonton dan Streaming $movie->title Subtitle Indonesia");
        SEO::metatags()->setKeywords("$movie->title, movie, anime");
        SEO::addImages([
          route('image.og', ['name' => $movie->cover])
        ]);

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

        SEO::setTitle("$page->title");

        return view('public.page', [
          'page'  => $page
        ]);
    }
}
