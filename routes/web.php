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

Route::get('/', function () {
    return view('public/index');
});

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
