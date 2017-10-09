<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Genre;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $genres = Genre::orderBy('name')->get();

        return view('admin/genre', [
            'heading' => 'Genres',
            'genres' => $genres,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:genres'
        ]);

        $genre = new Genre();
        $genre->name = $request->name;

        $genre->save();
        flash('Genre <strong>'. $request->name . '</strong> berhasil ditambahkan...')->success();

        $genres = $genre->orderBy('name')->get();


        return view('admin/genre', [
            'heading'     => 'Genres',
            'genres'      => $genres
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $genre = Genre::find($id);

        $movies = $genre->media->where('type', 'movie')->all();
        $series = $genre->media->where('type', 'series')->all();

        return view('admin/genre/show', [
            'heading'   => 'Genre of : ' . $genre->name,
            'genre'     => $genre,
            'movies'    => $movies,
            'series'    => $series
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $genre = Genre::find($id);

        return view('admin/genre/edit', [
          'heading'   => 'Edit Genre : '. $genre->name,
          'genre'     => $genre
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
        $genre = Genre::find($id);
        $genre->name = $request->genre;
        $genre->save();

        flash('Genre berhasil di update')->success();
        return redirect()->route('genre.edit', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $genre = Genre::find($id);
        $genre_name = $genre->name;
        $genre->media()->detach();

        $genre->delete();

        flash('Genre '. $genre_name .' berhasil dihapus.')->success();
        return redirect()->route('genre.index');
    }
}
