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
    public function index()
    {
        $movies = Movie::all();

        return view('admin/movies', [
            'adm_title' => 'Movies',
            'movies'    => $movies
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
        $genreToInsert = []; // declare untuk tempat penampungan genre
        $genreForMovie = []; // declare untuk tempat penampungan ID dari genre yang akan dipakai dalam series genres

        foreach ($genres as $genre) {
            $check_genre = Genre::where('id', '=', $genre)->first(); // query ke table genre, apakah id sudah ada atau tidak
            if ($check_genre === null) { // jika id belum ada
                $genreToInsert[] = [ //maka genre ditambahkan ke
                  'name' => $genre
                ];
            } else {
                // Jika ada id di dalam sana maka
              // id nya akan ditaruh di genre post container
              $genreForMovie [] = $genre;
            }
        }

        $genre = Genre::insert($genreToInsert); //tulis genre ke db

        // Mendapatkan ID dari yang baru saja ditulis di db
        foreach ($genreToInsert as $key => $value) {
            $genreGetIDQuery = Genre::where('name', $value)->first(); //mendapatkan ID dari genre
            $genreForMovie[] = $genreGetIDQuery->id; // dimasukkan kedalam array
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

        if ($request->hasFile('cover')){
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
        $genreToInsert = []; // declare untuk tempat penampungan genre
        $genreForMovie = []; // declare untuk tempat penampungan ID dari genre yang akan dipakai dalam series genres

        foreach ($genres as $genre) {
            $check_genre = Genre::where('id', '=', $genre)->first(); // query ke table genre, apakah id sudah ada atau tidak
            if ($check_genre === null) { // jika id belum ada
                $genreToInsert[] = [ //maka genre ditambahkan ke
                  'name' => $genre
                ];
            } else {
                // Jika ada id di dalam sana maka
              // id nya akan ditaruh di genre post container
              $genreForMovie [] = $genre;
            }
        }

        $genre = Genre::insert($genreToInsert); //tulis genre ke db

        // Mendapatkan ID dari yang baru saja ditulis di db
        foreach ($genreToInsert as $key => $value) {
            $genreGetIDQuery = Genre::where('name', $value)->first(); //mendapatkan ID dari genre
            $genreForMovie[] = $genreGetIDQuery->id; // dimasukkan kedalam array
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

        if ($request->hasFile('cover')){
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

        $movie->delete();

        flash('Movie berhasil di hapus')->success();

        return redirect()->route('movies.index');
    }
}
