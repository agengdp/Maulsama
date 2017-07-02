<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Genre;
use App\Movie;

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

        $movies = Movie::search($search)->paginate(20);

        return view('admin/movies', [
            'adm_title' => 'Movies',
            'movies'    => $movies,
            's' => $search
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
        'adm_title' => 'Create new movies',
        'genre_data' => $genre
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
            'cover' => 'required',
            'title' => 'required|max:255',
            'year'  => 'required',
            'creator' => 'required',
            'producer' => 'required',
            'genre' => 'required',
            'sinopsis' => 'required'
        ]);

        /*-------------------------------------------------------------------
        | Pembuatan genre dan pengaturan genre_id di table series
        ---------------------------------------------------------------------
        |
        | Jadi prosesnya adalah dengan cara mengecek terlebih dahulu
        | apakah yang ada di Request match apa tidak dengan id genre.
        | Jika tidak ada maka akan di buat baru genre nya
        | Kemudian di dapatkan id dari kedua genre baru tersebut
        | Selanjutnya di gabungkan dengan id sebelumnya (yang mungkin sudah ada)
        |
        */

        $genres = explode(',', $request->genre); //memecah string genre menjadi array

        foreach ($genres as $genre) {
            $genreForMovie [] = $genre;
        }

        /*----------------------------------------------------------------------
        | Init untuk menuliskan semuanya ke db
        ------------------------------------------------------------------------
        |
        | Jadi dengan ini penulisan ke db is done
        |
        */

        $movie = new Movie;
        $movie->title = $request->title;

        if ($request->hasFile('cover')) {
            $image = $request->file('cover')->store('public');
            $image_file_name = explode('/', $image);
            $movie->cover = $image_file_name[1];
        }

        $movie->year = $request->year;
        $movie->creator = $request->creator;
        $movie->producer = $request->producer;
        $movie->sinopsis = $request->sinopsis;
        $movie->links = json_encode($request->movie_video_list);

        $movie->save();

        $movie->genre()->sync($genreForMovie, false);

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
        $movie = Movie::find($id);
        $genre = Genre::all();

        return view('admin/movies/edit', [
            'adm_title' => 'Edit : ' . $movie->title,
            'movie' => $movie,
            'genre_data' => $genre,
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

        /*-------------------------------------------------------------------
        | Pembuatan genre dan pengaturan genre_id di table series
        ---------------------------------------------------------------------
        |
        | Jadi prosesnya adalah dengan cara mengecek terlebih dahulu
        | apakah yang ada di Request match apa tidak dengan id genre.
        | Jika tidak ada maka akan di buat baru genre nya
        | Kemudian di dapatkan id dari kedua genre baru tersebut
        | Selanjutnya di gabungkan dengan id sebelumnya (yang mungkin sudah ada)
        |
        */

        $genres = explode(',', $request->genre); //memecah string genre menjadi array

        foreach ($genres as $genre) {
            $genreForMovie [] = $genre;
        }

        /*----------------------------------------------------------------------
        | Init untuk menuliskan semuanya ke db
        ------------------------------------------------------------------------
        |
        | Jadi dengan ini penulisan ke db is done
        |
        */

        $movie = Movie::find($id);
        $movie->title = $request->title;

        if ($request->hasFile('cover')) {
            Storage::delete('public/'. $movie->cover); // hapus cover yang sebelumnya
            $image = $request->file('cover')->store('public');
            $image_file_name = explode('/', $image);
            $movie->cover = $image_file_name[1];
        }

        $movie->year = $request->year;
        $movie->creator = $request->creator;
        $movie->producer = $request->producer;
        $movie->sinopsis = $request->sinopsis;
        $movie->links = json_encode($request->movie_video_list);

        $movie->save();

        $movie->genre()->sync($genreForMovie);

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
