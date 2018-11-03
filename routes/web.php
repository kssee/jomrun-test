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

Route::get('/', 'IndexController@home')->name('home');
Route::get('favorite', 'IndexController@favorite')->name('favorite');
Route::get('logout', 'AuthController@logout')->name('logout');
Route::match(['get','post'],'sign-up', 'AuthController@signup')->name('signup');
Route::match(['get','post'],'log-in', 'AuthController@login')->name('login');
