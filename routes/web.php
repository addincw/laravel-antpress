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
    Route::resource('/galeri', 'GalleryController');
  });

  Route::group(['prefix' => '/profile', 'namespace' => 'Profile'], function () {
    Route::get('/kontak', 'ContactController@index');
    Route::post('/kontak', 'ContactController@store');

    Route::resource('/testimoni', 'TestimoniController');
  });
});

Route::get('/', function () {
    return view('pages.visitors.index');
});
Route::get('/profile/{slug}', function () {
    return view('pages.visitors.profile');
});
Route::group(['prefix' => '/klinik'], function () {
  Route::get('/', function () {
    return view('pages.visitors.clinic.index');
  });
  Route::get('/{slug}', function () {
    return view('pages.visitors.clinic._slug');
  });
});
Route::group(['prefix' => '/dokter'], function () {
  Route::get('/', function () {
    return view('pages.visitors.doctor.index');
  });
  Route::get('/{slug}', function () {
    return view('pages.visitors.doctor._slug');
  });
});
Route::group(['prefix' => '/blog'], function () {
  Route::get('/', function () {
    return view('pages.visitors.blog.index');
  });
  Route::get('/{slug}', function () {
    return view('pages.visitors.blog._slug');
  });
});
