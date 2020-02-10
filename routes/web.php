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
Route::group(['prefix' => '/admin'], function () {
  Route::get('/login', 'Auth\LoginController@index');
  Route::post('/login', 'Auth\LoginController@authenticate');
  
  // must login
  Route::group(['namespace' => 'Admins', 'middleware' => 'IsAdminAuthenticated'], function () {
    Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
    
    Route::get('/', function () {
      return view('pages.admins.index');
    });

    Route::resource('/dokter', 'DoctorController');
    Route::resource('/klinik', 'ClinicController');
    Route::resource('/jadwal-praktik', 'ScheduleController');
    Route::resource('/ijin-dokter', 'DoctorAbsentController');

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

    Route::group(['prefix' => '/registration', 'namespace' => 'Registration'], function () {
      Route::resource('/debitur', 'DebiturController');
      
      Route::resource('/setting', 'SettingController');
    });

    Route::resource('/kritik-saran', 'CriticSuggestionController');

    Route::group(['prefix' => '/profile', 'namespace' => 'Profile'], function () {
      Route::get('/profile', 'ProfileController@index');
      Route::post('/profile', 'ProfileController@store');

      Route::resource('/testimoni', 'TestimoniController');

      Route::resource('/faq', 'FaqController');
    });
  });
});

Route::group(['namespace' => 'Visitors'], function () {
  Route::get('/', 'LandingPageController@index');
  Route::get('/profile/{slug}', 'ProfileController@show');
  Route::get('/faq/{id}', 'FaqController@show');

  Route::group(['prefix' => '/layanan'], function () {
    Route::get('/', 'ClinicController@index');
    Route::get('/{slug}', 'ClinicController@show');
  });

  Route::group(['prefix' => '/dokter'], function () {
    Route::get('/', 'DoctorController@index');
    Route::get('/{slug}', 'DoctorController@show');
  });

  Route::group(['prefix' => '/event-blog'], function () {
    Route::get('/', 'BlogController@index');
    Route::get('/{slug}', 'BlogController@show');
    Route::post('/{slug}/comment', 'BlogController@storeComment');
  });


  Route::get('/galeri', 'GalleryController@index');
});

Route::post('/kritik-saran', 'Admins\CriticSuggestionController@store');
