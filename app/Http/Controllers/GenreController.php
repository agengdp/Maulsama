<?php

namespace App\Http\Controllers;

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
        	'genres' => $genres,
        	'adm_title' => 'Semua Genre'
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

        return view('admin/genre/show', [
        	'adm_title' => 'Genre of : ' . $genre->name,
        	'genre' => $genre
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
        //
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
        //
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
        $genre->series()->detach();
        $genre->movies()->detach();

        $genre->delete();

        flash('Genre '. $genre_name .' berhasil dihapus.')->success();
        return redirect()->route('genre.index');
    }
}
