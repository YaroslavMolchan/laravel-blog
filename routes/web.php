<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'ArticlesController@index')->name('articles.index');

Route::resource('articles', 'ArticlesController', [
    'except' => ['show', 'index']
]);

Route::resource('comments', 'CommentsController');
Route::resource('categories', 'CategoriesController', [
    'only' => ['show']
]);
Route::resource('tags', 'TagsController');

Route::get('/{id}/{slug}', 'ArticlesController@show')->where('id', '[0-9]+')->name('articles.show');
//Route::get('/category/{id}', 'ArticlesController@index')->where('id', '[0-9]+');

Route::post('/subscribe/create', 'SubscribeController@create');

Auth::routes();

Route::post('upload/imageUpload', 'UploadController@imageUpload');
Route::get('upload/imageManager', 'UploadController@imageManager');

Route::post('upload/fileUpload', 'UploadController@fileUpload');
Route::get('upload/fileManager', 'UploadController@fileManager');

Route::get('/home', 'HomeController@index');
