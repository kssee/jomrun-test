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

Route::group(['prefix' => 'movie', 'as' => 'movie'], function () {
    Route::match(['get','post'],'list', 'MovieController@movieList')->name('.list');
    Route::match(['get','post'],'favorite', 'MovieController@favoriteList')->name('.favorite');
});