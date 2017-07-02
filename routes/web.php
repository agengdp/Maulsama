<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('/home/series', 'SeriesController');

    Route::resource('/home/series.episode', 'EpisodeController', [
      'names' => [
        'store'  => 'episode.store',
        'update'  => 'episode.update',
        'destroy'  => 'episode.destroy'
      ],
      'only'  => [
        'store', 'update', 'destroy'
      ]

    ]);


    Route::resource('/home/movies', 'MovieController', [
      'except' => [
        'show'
      ]
    ]);

    Route::resource('/home/genre', 'GenreController');
});

/**
 * Damel front-End
 */

// Image resizing untuk vertical
Route::get('/images/vert/{image_name}', function ($image_name) {
    $img = Image::make('storage/'.$image_name)->resize(250, 375);
    return $img->response('jpg');
});

Route::get('/images/horz/{image_name}', function ($image_name) {
    $img = Image::make('storage/'.$image_name)->resize(496, 279);
    return $img->response('jpg');
});

Route::get('/images/eps/{image_name}', function ($image_name) {
    $img = Image::make('storage/'.$image_name)->resize(160, 90);
    return $img->response('jpg');
});

Route::get('/images/nav/{image_name}', function ($image_name) {
    $img = Image::make('storage/'.$image_name)->resize(64, null, function ($constraint) {
        $constraint->aspectRatio();
    });
    return $img->response('jpg');
});
Route::get('/images/ongoing/{image_name}', function ($image_name) {
    $img = Image::make('storage/'.$image_name)->resize(120, null, function ($constraint) {
        $constraint->aspectRatio();
    });
    return $img->response('jpg');
});
///////////////////////////////////////////////////////////
//
// Ini untuk routing home nya
//
Route::get('/', 'FrontHomeController@index')->name('frontHome');
Route::get('/browse', 'FrontBrowseController@index')->name('frontBrowse');
Route::get('/browse/{genre}', 'FrontBrowseController@browse')->name('frontBrowseGenre');

// mendapatkan series
Route::get('/series/{slug}', 'FrontSeriesController@index')->name('frontSeries');

// play episode
Route::get('/play/{series_slug}/{eps_slug}', 'FrontSeriesController@play')->name('frontPlayEps');

// mendapatkan movie
Route::get('/movie/{slug}', 'FrontMovieController@index')->name('frontMovie');
