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

// Route::post('/articles', 'ArticlesController@index');

Route::get('/articles', 'ArticlesController@index');
Route::post('/categories/{category}', 'CategoriesController@show');

Route::post('/search-articles', 'ArticlesController@search');

// Route::get('/articles', function () {
    // $results =  \App\Post::latest()->paginate(7);
    // $response = [
    //     'pagination' => [
    //         'total' => $results->total(),
    //         'per_page' => $results->perPage(),
    //         'current_page' => $results->currentPage(),
    //         'last_page' => $results->lastPage(),
    //         'from' => $results->firstItem(),
    //         'to' => $results->lastItem()
    //     ],
    //     'data' => $results
    // ];
    
    // return $response;
// });
