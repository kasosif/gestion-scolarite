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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register'=> false]);

Route::get('/dashboard', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth', 'admin']], function() {
    Route::get('/etudiants/annee', 'EtudiantController@index')->name('etudiant.index');
    Route::get('/etudiants/liste/{anne_id}', 'EtudiantController@list')->name('etudiant.liste');
    Route::get('/etudiant/ajout', 'EtudiantController@create')->name('etudiant.ajout');
    Route::post('/etudiant/store', 'EtudiantController@store')->name('etudiant.store');
    Route::get('/etudiant/classes/{spec_id?}', 'EtudiantController@getclasses')->name('etudiant.classes');
});

