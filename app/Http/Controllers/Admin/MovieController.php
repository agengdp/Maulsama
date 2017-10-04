<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Genre;
use App\Media;
use App\DownloadLink;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('s');

        $movies = Media::search($search)->where('type', 'movie')->paginate(20);

        return view('admin/movies', [
            'heading'   => 'Movies',
            'movies'    => $movies,
            's'         => $search
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genre = Genre::all();

        return view('admin/movies/create', [
        'heading'     => 'Create new movies',
        'genre_data'  => $genre
      ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'cover'     => 'required',
            'title'     => 'required|max:255',
            'year'      => 'required',
            'creator'   => 'required',
            'producer'  => 'required',
            'genre'     => 'required',
            'sinopsis'  => 'required'
        ]);

        /*-------------------------------------------------------------------
        | Pembuatan genre
        ---------------------------------------------------------------------
        |
        | Jika genre tidak ada (dengan cara mengecek terlebih dahulu),
        | maka genre baru akan dibuat, kemudian semua ID nya dikumpulkan
        | kedalam array $genrex dan kemudian di sync
        |
        */
        $genrex = [];
        foreach ($request->genre as $value) {
            if ($genre = Genre::where('name', $value)->first()) {
                array_push($genrex, $genre->id);
            } else {
                $newGenre = new Genre;
                $newGenre->name = $value;
                $newGenre->save();
                array_push($genrex, $newGenre->id);
            }
        }

        $media = new Media;
        $media->title = $request->title;

        if ($request->hasFile('cover')) {
            $image            = $request->file('cover')->store('public');
            $image_file_name  = explode('/', $image);
            $media->cover     = $image_file_name[1];
        }

        $media->year          = $request->year;
        $media->creator       = $request->creator;
        $media->producer      = $request->producer;
        $media->sinopsis      = $request->sinopsis;
        $media->type          = 'movie';

        $media->save();
        $media->genre()->sync($genrex, false);

        // build download link yang akan di attach dengan movie
        // di loop karena menggunakan save Many, biar nggak simpen satu2
        foreach ($request->movie_video_list as $value) {
            $download_link[] = new DownloadLink([
              'type'            => 'movie',
              'video_type'      => $value['video_type'],
              'video_quality'   => $value['video_quality'],
              'video_url'       => $value['video_url'],
            ]);
        }

        $media->download_links()->saveMany($download_link);

        flash('Movie baru berhasil ditambahkan')->success();
        return redirect()->route('movies.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $movie  = Media::find($id);
        $genres = Genre::all();

        /*-------------------------------------------------------------------
        | Manipulasi genre untuk penambahan attribute selected
        ---------------------------------------------------------------------
        |
        | Jadi loop dulu genre kesemuanya, dan kemudian loop lagi genre
        | yang dimiliki oleh series tersebut, kemudian override $genre
        | dan menambahkan attribute true pada genre yang ter select
        |
        */
        foreach ($genres as $value) {
            $genre[$value->id] = [
              'id'        => $value->id,
              'name'      => $value->name,
              'selected'  => false,
            ];
        }

        foreach ($movie->genre as $value) {
            $genre[$value->id] = [
              'id'        => $value->id,
              'name'      => $value->name,
              'selected'  => true,
            ];
        }

        return view('admin/movies/edit', [
            'heading'     => 'Edit : ' . $movie->title,
            'movie'       => $movie,
            'genres'      => $genre,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $media = Media::find($id);

        /*-------------------------------------------------------------------
        | Pembuatan genre
        ---------------------------------------------------------------------
        |
        | Jika genre tidak ada (dengan cara mengecek terlebih dahulu),
        | maka genre baru akan dibuat, kemudian semua ID nya dikumpulkan
        | kedalam array $genrex dan kemudian di sync
        |
        */
        $genrex = [];
        foreach ($request->genre as $value) {
            if ($genre = Genre::where('name', $value)->first()) {
                array_push($genrex, $genre->id);
            } else {
                $newGenre       = new Genre;
                $newGenre->name = $value;
                $newGenre->save();
                array_push($genrex, $newGenre->id);
            }
        }

        $media->title = $request->title;

        if ($request->hasFile('cover')) {
            Storage::delete('public/'. $media->cover); // hapus cover yang sebelumnya
            $image = $request->file('cover')->store('public');
            $image_file_name = explode('/', $image);
            $media->cover = $image_file_name[1];
        }

        $media->year      = $request->year;
        $media->creator   = $request->creator;
        $media->producer  = $request->producer;
        $media->sinopsis  = $request->sinopsis;

        $media->save();
        $media->genre()->sync($genrex);
        $media->download_links()->delete();

        // build download link yang akan di attach dengan movie
        // di loop karena menggunakan save Many, biar nggak simpen satu2
        foreach ($request->movie_video_list as $value) {
            $download_link[] = new DownloadLink([
              'type'            => 'movie',
              'video_type'      => $value['video_type'],
              'video_quality'   => $value['video_quality'],
              'video_url'       => $value['video_url'],
            ]);
        }

        $media->download_links()->saveMany($download_link);
        flash('Movie berhasil di update')->success();
        return redirect()->route('movies.edit', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = Movie::find($id);
        $movie->genre()->detach();

        Storage::delete('public/'. $movie->cover); // hapus cover

        $movie->delete();

        flash('Movie berhasil di hapus')->success();

        return redirect()->route('movies.index');
    }
}
