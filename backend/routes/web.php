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
    return view('welcome');
});

Route::group(['prefix' => 'picture'], function ()  {

    Route::get('/upload', "DimagesController@upload")->name('image-upload' );

    Route::get('{domain}/{slug}/{profile}/{density}/{index?}', "DimController@full");
    Route::get('{domain}/{slug}/{index?}', "DimController@original");

    Route::get('/', "DimagesController@index");
});

Route::post('/store', 'DimagesController@store')->name('image-store' );
