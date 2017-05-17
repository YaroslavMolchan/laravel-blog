<?php

//Auth routes
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

//Articles routes
Route::get('/', 'ArticlesController@index')->name('articles.index');
Route::get('/{id}/{slug}', 'ArticlesController@show')->where('id', '[0-9]+')->name('articles.show');
Route::get('/search', 'ArticlesController@search')->name('articles.search');

Route::resource('articles', 'ArticlesController', [
    'except' => ['show', 'index']
]);

//Article form editor actions
Route::post('upload/imageUpload', 'UploadController@imageUpload');
Route::get('upload/imageManager', 'UploadController@imageManager');

Route::post('upload/fileUpload', 'UploadController@fileUpload');
Route::get('upload/fileManager', 'UploadController@fileManager');

Route::resource('comments', 'CommentsController', [
    'only' => ['store', 'update', 'destroy']
]);

Route::resource('categories', 'CategoriesController', [
    'only' => ['show']
]);

Route::resource('tags', 'TagsController');

Route::resource('books', 'BooksController', [
    'except' => ['show']
]);

Route::post('/subscribe/create', 'SubscribeController@create');