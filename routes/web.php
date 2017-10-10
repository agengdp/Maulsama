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

Route::group(['prefix' => 'app', 'middleware' => ['auth', 'role:admin|root']], function () {
    Route::get('/', 'Admin\HomeController@index')->name('app');
    Route::resource('/series', 'Admin\SeriesController');
    Route::resource('/series.episode', 'Admin\EpisodeController', [
      'names' => [
        'store'     => 'episode.store',
        'update'    => 'episode.update',
        'destroy'   => 'episode.destroy'
      ],
      'only'  => [
        'store', 'update', 'destroy'
      ]
    ]);

    Route::resource('/movies', 'Admin\MovieController', [
      'except' => [
        'show'
      ],
    ]);

    Route::resource('/genre', 'Admin\GenreController');

    Route::group(['middleware' => 'role:root'], function () {
        Route::resource('/pages', 'Admin\PageController');
        Route::resource('/users', 'Admin\UserController');
    });
});

Route::group(['prefix' => 'me', 'middleware' => ['auth', 'role:user|admin|root']], function () {
    Route::get('/', function () {
        echo "Registered user";
    })->name('me');
});

/**
 * Damel front-End
 */
Route::group(['prefix' => 'images'], function () {
    // Image resizing untuk vertical
    Route::get('/vert/{image_name}', function ($image_name) {
        $img = Image::make('storage/'.$image_name)->resize(250, 375);
        return $img->response('jpg');
    });

    Route::get('/horz/{image_name}', function ($image_name) {
        $img = Image::make('storage/'.$image_name)->resize(496, 279);
        return $img->response('jpg');
    });

    Route::get('/eps/{image_name}', function ($image_name) {
        $img = Image::make('storage/'.$image_name)->resize(160, 90);
        return $img->response('jpg');
    });

    Route::get('/nav/{image_name}', function ($image_name) {
        $img = Image::make('storage/'.$image_name)->resize(64, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        return $img->response('jpg');
    });
    Route::get('/ongoing/{image_name}', function ($image_name) {
        $img = Image::make('storage/'.$image_name)->resize(120, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        return $img->response('jpg');
    });

    Route::get('/logo/{name}_{width}.png', function ($name, $width) {
        $img = Image::make('storage/assets/images/'.$name. '.png')->resize($width, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        return $img->response('png');
    });
});

///////////////////////////////////////////////////////////
//
// Ini untuk routing home nya
//
Route::get('/', 'FrontController@index')->name('frontHome');
Route::get('/browse', 'FrontController@browse')->name('frontBrowse');
Route::get('/browse/{genre}', 'FrontController@browseGenre')->name('frontBrowseGenre');

// mendapatkan series
Route::get('/series/{slug}', 'FrontController@series')->name('frontSeries');

// play episode
Route::get('/play/{series_slug}/{eps_slug}', 'FrontController@playEpisode')->name('frontPlayEps');

// mendapatkan movie
Route::get('/movie/{slug}', 'FrontController@movie')->name('frontMovie');
Route::get('/page/{page}', 'FrontController@page')->name('frontPage');
