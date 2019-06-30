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

Route::post('/auth/login', 'Api\AuthController@login');
Route::post('/auth/logout', 'Api\AuthController@logout');
Route::get('/auth/me', 'Api\ProfileController@me');
Route::put('/changepassword', 'Api\ProfileController@changepassword');
Route::get('/schedule', 'Api\EmploiController@myschedule');
Route::get('/exams', 'Api\DevoirController@myexams');
Route::get('/myabscences', 'Api\AbscenceController@myabscences');
Route::get('/feeds', 'Api\FeedController@feeds');
