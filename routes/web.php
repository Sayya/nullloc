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

Route::get   ('/',                         'PostController@index')->middleware('auth');
Route::post  ('/save/{note_id?}',          'PostController@save')->middleware('auth');
Route::get   ('/{post_id}/note',           'NoteController@index')->middleware('auth');
Route::get   ('/{post_id}/note/{note_id}', 'NoteController@open')->middleware('auth');
Route::post  ('/{post_id}/note/save',      'NoteController@save')->middleware('auth');
Route::get   ('/file/edit',                'FileController@edit')->middleware('auth');
Route::post  ('/file/save',                'FileController@save')->middleware('auth');
Route::get   ('/file/{file_id}',           'FileController@open')->middleware('auth');
Route::delete('/file/{file_id}/del',       'FileController@del')->middleware('auth');
Route::get   ('/search',                   'SearchController@search')->middleware('auth');
Route::get   ('/search/{post_id}/note',           'SearchController@note_index')->middleware('auth');
Route::get   ('/search/{post_id}/note/{note_id}', 'SearchController@note_open')->middleware('auth');

/*
Route::delete('/post/{id}', function ($id) {
  Post::findOrFail($id)->delete();

  return redirect('/');
})->middleware('auth');
*/

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
