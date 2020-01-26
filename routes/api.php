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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// Create new book
Route::post('v1/books', 'CrudController@storeBook')->name('books.store');

// List books
Route::get('v1/books', 'CrudController@bookIndex')->name('books.list');

// Update book
Route::put('v1/books/{id}', 'CrudController@updateBook')->name('books.update');

// List single book
Route::get('v1/books/{id}', 'CrudController@showBook')->name('books.show');

// Delete book
Route::delete('books/{id}', 'CrudController@destroyBook')->name('books.delete');


Route::get('external-books', 'ApiController@index');

