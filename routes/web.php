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

Auth::routes(['register'=> false]);


Route::group(['middleware' => ['auth', 'admin']], function() {

    //dashboard
    Route::get('/', 'HomeController@index')->name('home');

    //etudiants

    Route::get('/etudiants/annee', 'EtudiantController@index')->name('etudiant.index');
    Route::get('/etudiants/liste/{anne_id}', 'EtudiantController@list')->name('etudiant.liste');
    Route::get('/etudiant/ajout', 'EtudiantController@create')->name('etudiant.ajout');
    Route::post('/etudiant/store', 'EtudiantController@store')->name('etudiant.store');
    Route::get('/etudiant/edit/{cin}', 'EtudiantController@edit')->name('etudiant.edit');
    Route::put('/etudiant/update/{cin}', 'EtudiantController@update')->name('etudiant.update');
    Route::delete('/etudiant/destroy/{cin?}', 'EtudiantController@destroy')->name('etudiant.destroy');
    Route::get('/etudiant/classes/{spec_id?}', 'EtudiantController@getclasses')->name('etudiant.classes');

    //professeurs

    Route::get('/professeurs', 'ProfesseurController@index')->name('professeur.index');
    Route::get('/professeurs/ajout', 'ProfesseurController@create')->name('professeur.ajout');
    Route::post('/professeurs/store', 'ProfesseurController@store')->name('professeur.store');
    Route::delete('/professeurs/destroy/{cin?}', 'ProfesseurController@destroy')->name('professeur.destroy');
    Route::get('/professeurs/edit/{cin}', 'ProfesseurController@edit')->name('professeur.edit');
    Route::put('/professeurs/update/{cin}', 'ProfesseurController@update')->name('professeur.update');

    //actualitées

    Route::get('/feeds', 'FeedController@index')->name('feed.index');
    Route::get('/feeds/ajout', 'FeedController@create')->name('feed.ajout');
    Route::post('/feeds/store', 'FeedController@store')->name('feed.store');
    Route::delete('/feeds/destroy/{id?}', 'FeedController@destroy')->name('feed.destroy');
    Route::get('/feeds/edit/{id}', 'FeedController@edit')->name('feed.edit');
    Route::put('/feeds/update/{id}', 'FeedController@update')->name('feed.update');

    Route::get('/feeds/classes', 'FeedController@getclasses')->name('feed.allclasses');
    Route::get('/feeds/students', 'FeedController@getstudents')->name('feed.allstudents');
    Route::get('/feeds/teachers', 'FeedController@getteachers')->name('feed.allteachers');

    //années

    Route::get('/annees/', 'AnneeController@index')->name('annee.index');
    Route::get('/annees/ajout', 'AnneeController@create')->name('annee.ajout');
    Route::post('/annees/store', 'AnneeController@store')->name('annee.store');
    Route::get('/annees/edit/{id}', 'AnneeController@edit')->name('annee.edit');
    Route::get('/annees/show/{id}', 'AnneeController@show')->name('annee.show');
    Route::put('/annees/update/{id}', 'AnneeController@update')->name('annee.update');
    Route::delete('/annees/destroy/{id?}', 'AnneeController@destroy')->name('annee.destroy');

    //semestres

    Route::get('/semestres/', 'SemestreController@index')->name('semestre.index');
    Route::get('/semestres/ajout', 'SemestreController@create')->name('semestre.ajout');
    Route::post('/semestres/store', 'SemestreController@store')->name('semestre.store');
    Route::get('/semestres/edit/{id}', 'SemestreController@edit')->name('semestre.edit');
    Route::get('/semestres/show/{id}', 'SemestreController@show')->name('semestre.show');
    Route::put('/semestres/update/{id}', 'SemestreController@update')->name('semestre.update');
    Route::delete('/semestres/destroy/{id?}', 'SemestreController@destroy')->name('semestre.destroy');

    //specialités

    Route::get('/specialites/', 'SpecialiteController@index')->name('specialite.index');
    Route::get('/specialites/ajout', 'SpecialiteController@create')->name('specialite.ajout');
    Route::post('/specialites/store', 'SpecialiteController@store')->name('specialite.store');
    Route::get('/specialites/edit/{id}', 'SpecialiteController@edit')->name('specialite.edit');
    Route::get('/specialites/show/{id}', 'SpecialiteController@show')->name('specialite.show');
    Route::put('/specialites/update/{id}', 'SpecialiteController@update')->name('specialite.update');
    Route::delete('/specialites/destroy/{id?}', 'SpecialiteController@destroy')->name('specialite.destroy');

    //classes

    Route::get('/classes/', 'ClasseController@index')->name('classe.index');
    Route::get('/classes/ajout', 'ClasseController@create')->name('classe.ajout');
    Route::post('/classes/store', 'ClasseController@store')->name('classe.store');
    Route::get('/classes/edit/{id}', 'ClasseController@edit')->name('classe.edit');
    Route::get('/classes/show/{id}', 'ClasseController@show')->name('classe.show');
    Route::put('/classes/update/{id}', 'ClasseController@update')->name('classe.update');
    Route::delete('/classes/destroy/{id?}', 'ClasseController@destroy')->name('classe.destroy');

    //seances

    Route::get('/seances/', 'SeanceController@index')->name('seance.index');
    Route::get('/seances/ajout', 'SeanceController@create')->name('seance.ajout');
    Route::post('/seances/store', 'SeanceController@store')->name('seance.store');
    Route::get('/seances/edit/{id}', 'SeanceController@edit')->name('seance.edit');
    Route::put('/seances/update/{id}', 'SeanceController@update')->name('seance.update');
    Route::delete('/seances/destroy/{id?}', 'SeanceController@destroy')->name('seance.destroy');

    //matieres

    Route::get('/matieres/', 'MatiereController@index')->name('matiere.index');
    Route::get('/matieres/ajout', 'MatiereController@create')->name('matiere.ajout');
    Route::post('/matieres/store', 'MatiereController@store')->name('matiere.store');
    Route::get('/matieres/edit/{id}', 'MatiereController@edit')->name('matiere.edit');
    Route::put('/matieres/update/{id}', 'MatiereController@update')->name('matiere.update');
    Route::delete('/matieres/destroy/{id?}', 'MatiereController@destroy')->name('matiere.destroy');

    //devoirs

    Route::get('/devoirs/', 'DevoirController@index')->name('devoir.index');
    Route::get('/devoirs/ajout', 'DevoirController@create')->name('devoir.ajout');
    Route::post('/devoirs/store', 'DevoirController@store')->name('devoir.store');
    Route::get('/devoirs/edit/{id}', 'DevoirController@edit')->name('devoir.edit');
    Route::put('/devoirs/update/{id}', 'DevoirController@update')->name('devoir.update');
    Route::delete('/devoirs/destroy/{id?}', 'DevoirController@destroy')->name('devoir.destroy');

    //salles

    Route::get('/salles/', 'SalleController@index')->name('salle.index');
    Route::get('/salles/ajout', 'SalleController@create')->name('salle.ajout');
    Route::post('/salles/store', 'SalleController@store')->name('salle.store');
    Route::get('/salles/edit/{id}', 'SalleController@edit')->name('salle.edit');
    Route::put('/salles/update/{id}', 'SalleController@update')->name('salle.update');
    Route::delete('/salles/destroy/{id?}', 'SalleController@destroy')->name('salle.destroy');
});

