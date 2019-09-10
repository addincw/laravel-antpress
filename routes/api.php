<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['namespace' => 'Api'], function () {
    Route::get('/banner', 'Contents\GalleryController@getHighlightImage');

    Route::get('/profile', 'ProfileController@index');
    
    Route::apiResource('/tag', 'TagController');
    
    Route::get('/content/all', 'Contents\ContentController@getAll');
    Route::apiResource('/content', 'Contents\ContentController');
    
    Route::apiResource('/doctor', 'DoctorController');

    Route::apiResource('/clinic', 'ClinicController');
});
