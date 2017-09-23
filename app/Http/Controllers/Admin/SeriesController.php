<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Media;
use App\Episode;
use App\Genre;
use Response;
use Image;

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
        $media = Media::search($search)->paginate(20);

        $data = (object)[
            'title'     => 'Series',
            'media'     => [
                'series'    => $media
            ],
        ];
        
        return view('admin/series', [
            'data'  => $data,
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

        return view('admin/series/create', [
        'adm_title' => 'Create new series',
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
          'title' => 'required|unique:series|max:255',
          'year' => 'required',
          'creator' => 'required',
          'producer' => 'required',
          'genre' => 'required',
          'sinopsis' => 'required',
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
            $genreForSeries [] = $genre;
        }

        /*----------------------------------------------------------------------
        | Init untuk menuliskan semuanya ke db
        ------------------------------------------------------------------------
        |
        | Jadi dengan ini penulisan ke db is done
        |
        */

        $series = new Series;
        $series->title = $request->title;

        if ($request->hasFile('cover')) {
            $image = $request->file('cover')->store('public');
            $image_file_name = explode('/', $image);
            $series->cover = $image_file_name[1];
        }

        $series->year     = $request->year;
        $series->creator  = $request->creator;
        $series->producer = $request->producer;
        $series->sinopsis = $request->sinopsis;

        $series->save();

        $series->genre()->sync($genreForSeries, false);

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
        $series = Series::find($id);
        $episodes = Episode::where('series_id', $id)
                            ->orderBy('episode', 'desc')
                            ->paginate(15);

        return view('admin/series/show', [
          'adm_title' => 'Show : '. $series->title,
          'series' => $series,
          'episodes' => $episodes
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
        $series = Series::find($id);

        $genre = Genre::all();

        return view('admin/series/edit', [
        'adm_title' => 'Edit : '. $series->title,
        'series' => $series,
        'genre_data' => $genre
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
        $updateSeries = Series::find($id);


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
            $genreForSeries [] = $genre;
        }

        $updateSeries->title = $request->title;

        if ($request->hasFile('cover')) {
            \Storage::delete('public/'. $updateSeries->cover); // hapus cover yang sebelumnya
          $image = $request->file('cover')->store('public');
            $image_file_name = explode('/', $image);
            $updateSeries->cover = $image_file_name[1];
        }

        $updateSeries->year = $request->year;
        $updateSeries->creator = $request->creator;
        $updateSeries->producer = $request->producer;
        $updateSeries->sinopsis = $request->sinopsis;

        $updateSeries->save();

        $updateSeries->genre()->sync($genreForSeries); // tulisan false dibelakang dihilangkan karena untuk 'detach' genre


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
        $series = Series::find($id);
        $series->genre()->detach(); // detach / hapus genre dari series yang berkaitan (bukan hapus, tapi melepas relationship)

        $series->delete();

        flash('Data telah berhasil dihapus')->success();
        return redirect()->route('series.index');
    }
}
