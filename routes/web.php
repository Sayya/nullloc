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

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get ('/',     'PostController@index')->middleware('auth');
Route::post('/save', 'PostController@save')->middleware('auth');
Route::post('/locus',      'LocusController@input')->middleware('auth');
Route::post('/locus/save', 'LocusController@save')->middleware('auth');
Route::get ('/locus/{id}', 'LocusController@index')->middleware('auth');

/*
Route::delete('/post/{id}', function ($id) {
  Post::findOrFail($id)->delete();

  return redirect('/');
})->middleware('auth');
*/

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
