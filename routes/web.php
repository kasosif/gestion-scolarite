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
    Route::get('/etudiant/edit/{cin}', 'EtudiantController@edit')->name('etudiant.edit');
    Route::put('/etudiant/update/{cin}', 'EtudiantController@update')->name('etudiant.update');
    Route::delete('/etudiant/destroy/{cin?}', 'EtudiantController@destroy')->name('etudiant.destroy');
    Route::get('/etudiant/classes/{spec_id?}', 'EtudiantController@getclasses')->name('etudiant.classes');
    Route::get('/professeurs', 'ProfesseurController@index')->name('professeur.index');
    Route::get('/professeurs/ajout', 'ProfesseurController@create')->name('professeur.ajout');
    Route::post('/professeurs/store', 'ProfesseurController@store')->name('professeur.store');
    Route::delete('/professeurs/destroy/{cin?}', 'ProfesseurController@destroy')->name('professeur.destroy');
    Route::get('/professeurs/edit/{cin}', 'ProfesseurController@edit')->name('professeur.edit');
    Route::put('/professeurs/update/{cin}', 'ProfesseurController@update')->name('professeur.update');
    Route::get('/feeds', 'FeedController@index')->name('feed.index');
    Route::get('/feeds/ajout', 'FeedController@create')->name('feed.ajout');
    Route::post('/feeds/store', 'FeedController@store')->name('feed.store');
    Route::delete('/feeds/destroy/{id?}', 'FeedController@destroy')->name('feed.destroy');
    Route::get('/feeds/edit/{id}', 'FeedController@edit')->name('feed.edit');
    Route::put('/feeds/update/{id}', 'FeedController@update')->name('feed.update');
    Route::get('/feeds/classes', 'FeedController@getclasses')->name('feed.allclasses');
    Route::get('/feeds/students', 'FeedController@getstudents')->name('feed.allstudents');
    Route::get('/feeds/teachers', 'FeedController@getteachers')->name('feed.allteachers');
});

