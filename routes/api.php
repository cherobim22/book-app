<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('api')->get('books', 'App\Http\Controllers\BookController@index');
Route::middleware('api')->post('books', 'App\Http\Controllers\BookController@store');
Route::middleware('api')->get('books/{id}', 'App\Http\Controllers\BookController@show');
Route::middleware('api')->put('books/{id}', 'App\Http\Controllers\BookController@update');
Route::middleware('api')->delete('books/{id}', 'App\Http\Controllers\BookController@destroy');


Route::post('login', 'App\Http\Controllers\AuthController@login');
Route::post('register', 'App\Http\Controllers\AuthController@store');
Route::middleware('api')->post('logout', 'App\Http\Controllers\AuthController@logout');
