<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('external-books', 'HomeController@ListOfBooks');
Route::get('external-books/{no}', 'HomeController@GetSpecificBook');
Route::post('create-book', 'HomeController@CreateBook');
Route::get('list-books','HomeController@ListBooks');
Route::post('update-book/{id}','HomeController@UpdateBook');
Route::get('delete-book/{id}','HomeController@DeleteBook');
Route::get('show-book/{id}','HomeController@ShowBook');





