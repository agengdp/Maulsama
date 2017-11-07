<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Media;
use App\Episode;
use App\Genre;
use Response;
use Image;
use Purifier;

class SeriesController extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('s');
        $series = Media::search($search)->where('type', 'series')->orderBy('status', 'desc')->latest()->paginate(20);

        return view('admin/series/series', [
            'heading' => 'Series',
            'series'  => $series,
            's'       => $search
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

        return view('admin/series/create', [
        'genre_data'  => $genre,
        'heading'     => 'Create New Series'
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
          'title'     => 'required|unique:media|max:255',
          'year'      => 'required',
          'creator'   => 'required',
          'producer'  => 'required',
          'genre'     => 'required',
          'sinopsis'  => 'required',
        ]);

        $media = new Media;

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

        if ($request->hasFile('cover')) {
            $image = $request->file('cover')->store('public');
            $image_file_name = explode('/', $image);
            $media->cover = $image_file_name[1];
        }

        $media->title     = $request->title;
        $media->year      = $request->year;
        $media->creator   = $request->creator;
        $media->producer  = $request->producer;
        $media->sinopsis  = Purifier::clean($request->sinopsis);
        $media->type      = 'series';
        $media->status    = $request->status;
        $media->save();
        $media->genre()->sync($genrex, false);

        flash('Series baru telah ditambahkan')->success();
        return redirect()->route('series.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $series = Media::find($id);
        $episodes = Episode::where('series_id', $id)
                            ->orderBy('episode', 'desc')
                            ->paginate(15);

        return view('admin/series/show', [
          'heading'   => 'Show : '.$series->title,
          'adm_title' => 'Show : '. $series->title,
          'series'    => $series,
          'episodes'  => $episodes
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
        $series = Media::find($id);
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

        foreach ($series->genre as $value) {
            $genre[$value->id] = [
              'id'        => $value->id,
              'name'      => $value->name,
              'selected'  => true,
            ];
        }

        return view('admin/series/edit', [
          'heading'     => 'Edit : '. $series->title,
          'series'      => $series,
          'genres'      => $genre
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
        $updateSeries = Media::find($id);

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

        $updateSeries->title = $request->title;

        if ($request->hasFile('cover')) {
            \Storage::delete('public/'. $updateSeries->cover); // hapus cover yang sebelumnya
            $image = $request->file('cover')->store('public');
            $image_file_name = explode('/', $image);
            $updateSeries->cover = $image_file_name[1];
        }

        $updateSeries->year     = $request->year;
        $updateSeries->creator  = $request->creator;
        $updateSeries->producer = $request->producer;
        $updateSeries->sinopsis = Purifier::clean($request->sinopsis);
        $updateSeries->status   = $request->status;
        $updateSeries->save();
        $updateSeries->genre()->sync($genrex); // tulisan false dibelakang dihilangkan karena untuk 'detach' genre

        flash('Data berhasil diubah!')->success();

        return redirect()->route('series.edit', $id);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $series = Media::find($id);
        $series->genre()->detach(); // detach / hapus genre dari series yang berkaitan (bukan hapus, tapi melepas relationship)

        $series->delete();

        flash('Data telah berhasil dihapus')->success();
        return redirect()->route('series.index');
    }
}
