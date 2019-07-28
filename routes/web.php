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
Route::group(['prefix' => '/admin', 'namespace' => 'Admins'], function () {
  Route::get('/', function () {
    return view('pages.admins.index');
  });

  Route::resource('/klinik', 'ClinicController');

  Route::group(['prefix' => '/konten', 'namespace' => 'Content'], function () {
    Route::resource('/konten', 'ContentController');
    Route::resource('/kategori', 'CategoryController');

    Route::get('/galeri/create-single', 'GalleryController@createSingle');
    Route::post('/galeri/create-single', 'GalleryController@storeSingle');
    Route::resource('/galeri', 'GalleryController');
  });

  Route::group(['prefix' => '/profile', 'namespace' => 'Profile'], function () {
    Route::get('/kontak', 'ContactController@index');
    Route::post('/kontak', 'ContactController@store');

    Route::resource('/testimoni', 'TestimoniController');
  });
});

Route::group(['namespace' => 'Visitors'], function () {
  Route::get('/', 'LandingPageController@index');
  Route::get('/profile/{slug}', 'ProfileController@show');

  Route::group(['prefix' => '/klinik'], function () {
    Route::get('/', 'ClinicController@index');
    Route::get('/{slug}', 'ClinicController@show');
  });

  Route::group(['prefix' => '/dokter'], function () {
    Route::get('/', 'DoctorController@index');
    Route::get('/{slug}', 'DoctorController@show');
  });

  Route::group(['prefix' => '/blog'], function () {
    Route::get('/', 'BlogController@index');
    Route::get('/{slug}', 'BlogController@show');
    Route::post('/{slug}/comment', 'BlogController@storeComment');
  });
});
