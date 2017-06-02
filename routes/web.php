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

    Route::resource('/home/genre', 'GenreController', [
      'except' => [
        'create', 'store'
      ]

    ]);

});

/**
 * Damel front-End
 */

// Image resizing untuk vertical
Route::get('/images/vert/{image_name}', function($image_name){
    $img = Image::make('storage/'.$image_name)->resize(250, 375);
    return $img->response('jpg');
});

Route::get('/images/horz/{image_name}', function($image_name){
    $img = Image::make('storage/'.$image_name)->resize(496, 279);
    return $img->response('jpg');
});


///////////////////////////////////////////////////////////
//
// Ini untuk routing home nya
//
Route::get('/', 'FrontHomeController@index')->name('frontHome');
Route::get('/browse', 'FrontBrowseController@index')->name('frontBrowse');

Route::get('/series/{slug}', 'FrontSeriesController@index')->name('frontSeries');
