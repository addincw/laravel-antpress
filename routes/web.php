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
Route::group(['prefix' => '/backsite'], function () {
  Route::get('/login', 'Auth\LoginController@index');
  Route::post('/login', 'Auth\LoginController@authenticate');
  
  // must login
  Route::group(['namespace' => 'Backsite', 'middleware' => 'IsAdminAuthenticated'], function () {
    Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
    
    Route::get('/', function () {
      return view('backsite.index');
    });

    Route::group(['prefix' => '/konten', 'namespace' => 'Content'], function () {
      Route::resource('/konten', 'ContentController');
      Route::resource('/kategori', 'CategoryController');

      Route::get('/galeri/single', 'GalleryController@createSingle');
      Route::post('/galeri/single', 'GalleryController@storeSingle');

      Route::get('/galeri/video', 'GalleryController@createVideo');
      Route::post('/galeri/video', 'GalleryController@storeVideo');
      Route::get('/galeri/video/{id}/edit', 'GalleryController@editVideo');
      Route::put('/galeri/video/{id}', 'GalleryController@updateVideo');

      Route::resource('/galeri', 'GalleryController');
    });

    Route::resource('/critic-suggestion', 'CriticSuggestionController');

    Route::group(['prefix' => '/site', 'namespace' => 'Site'], function () {
      Route::get('/configuration', 'ConfigurationController@index');
      Route::post('/configuration', 'ConfigurationController@store');

      Route::resource('/testimoni', 'TestimoniController');

      Route::resource('/faq', 'FaqController');
    });
  });
});

Route::group(['namespace' => 'Frontsite'], function () {
  Route::get('/', 'LandingPageController@index');

  Route::get('/site/configuration', 'ConfigurationController@show');

  Route::get('/faq/{id}', 'FaqController@show');

  Route::group(['prefix' => '/event-blog'], function () {
    Route::get('/', 'BlogController@index');
    Route::get('/{slug}', 'BlogController@show');
    Route::post('/{slug}/comment', 'BlogController@storeComment');
  });


  Route::get('/galeri', 'GalleryController@index');
});

Route::post('/critic-suggestion', 'Backsite\Feedback\CriticSuggestionController@store');
