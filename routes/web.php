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

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('picture', 'PictureController@index');
Route::get('picture/create', 'PictureController@create');
Route::get('picture/{picture}', 'PictureController@show');
Route::post('picture', 'PictureController@store');

Route::get('tag', 'TagController@index');