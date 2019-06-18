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

Route::post('/login', 'Api\AuthController@login');
Route::post('/logout', 'Api\AuthController@logout');
Route::get('/me', 'Api\ProfileController@me');
Route::put('/changepassword', 'Api\ProfileController@changepassword');
Route::get('/myschedule', 'Api\EmploiController@myschedule');
Route::get('/myexams', 'Api\DevoirController@myexams');
Route::get('/myabscences', 'Api\AbscenceController@myabscences');
Route::get('/feeds', 'Api\FeedController@feeds');
