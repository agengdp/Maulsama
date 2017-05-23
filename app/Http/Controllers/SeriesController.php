<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Series;
use App\Episode;
use App\Genre;
use Response;

class SeriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $series = Series::all();

        return view('admin/series', [
          'adm_title' => 'Series',
          'series'    => $series
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
        $genreToInsert = []; // declare untuk tempat penampungan genre
        $genreForSeries = []; // declare untuk tempat penampungan ID dari genre yang akan dipakai dalam series genres

        foreach ($genres as $genre) {
            $check_genre = Genre::where('id', '=', $genre)->first(); // query ke table genre, apakah id sudah ada atau tidak
            if ($check_genre === null) { // jika id belum ada
                $genreToInsert[] = [ //maka genre ditambahkan ke
                  'name' => $genre
                ];
            } else {
                // Jika ada id di dalam sana maka
              // id nya akan ditaruh di genre post container
              $genreForSeries [] = $genre;
            }
        }

        $genre = Genre::insert($genreToInsert); //tulis genre ke db

        // Mendapatkan ID dari yang baru saja ditulis di db
        foreach ($genreToInsert as $key => $value) {
            $genreGetIDQuery = Genre::where('name', $value)->first(); //mendapatkan ID dari genre
            $genreForSeries[] = $genreGetIDQuery->id; // dimasukkan kedalam array
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

        // mendapatakan file yang di upload
        $file = $request->file('cover');
        $image_name = create_slug($request->title) . '.jpg';
        $file->move('images', $image_name); //dipindahkan kdealam folder images

        $series->cover    = $image_name; // tulis nama file ke db
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

        $genreToInsert = []; // declare untuk tempat penampungan genre
        $genreForSeries = []; // declare untuk tempat penampungan ID dari genre yang akan dipakai dalam series genres

        foreach ($genres as $genre) {
            $check_genre = Genre::where('id', '=', $genre)->first(); // query ke table genre, apakah id sudah ada atau tidak

            if ($check_genre === null) { // jika id belum ada
                $genreToInsert[] = [ //maka genre ditambahkan ke
                  'name' => $genre
                ];
            } else {

              // Jika ada id di dalam sana maka
              // id nya akan ditaruh di genre post container
              $genreForSeries [] = $genre;
            }
        }

        $genre = Genre::insert($genreToInsert); //tulis genre ke db

        // Mendapatkan ID dari yang baru saja ditulis di db
        foreach ($genreToInsert as $key => $value) {
            $genreGetIDQuery = Genre::where('name', $value)->first();
            $genreForSeries[] = $genreGetIDQuery->id;
        }

        $updateSeries->title = $request->title;

        if ($request->hasFile('cover')) {

            // mendapatakan file yang di upload
            $file = $request->file('cover');
            $image_name = create_slug($request->title) . '.jpg';
            $file->move('images', $image_name); //dipindahkan kdealam folder images

          $updateSeries->cover = $image_name; // tulis nama file ke db
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
        $series->delete();

        flash('Data telah berhasil dihapus')->success();
        return redirect()->route('series.index');
    }
}
