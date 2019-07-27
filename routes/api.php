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
//Auth
Route::post('/auth/login', 'Api\AuthController@login');
Route::post('/auth/logout', 'Api\AuthController@logout');
Route::get('/auth/me', 'Api\ProfileController@me');
Route::put('/auth/changepassword', 'Api\ProfileController@changepassword');
Route::post('/auth/forgotpassword', 'Api\ForgotPasswordController@getResetToken');
Route::post('/auth/resetpassword', 'Api\ResetPasswordController@reset');
//Demandes
Route::post('/demandes', 'Api\DemandeController@add');
Route::get('/demandes', 'Api\DemandeController@mydemandes');
//Emploi
Route::get('/schedule', 'Api\EmploiController@myschedule');
//Notifications
Route::get('/lastnotifs', 'Api\AuthController@lastnotifs');
Route::get('/notifs', 'Api\NotifController@notifs');
Route::patch('/notifs', 'Api\NotifController@allread');
//Devoirs
Route::get('/exams', 'Api\DevoirController@myexams');
Route::post('/exams', 'Api\DevoirController@add');
Route::get('/examsforprofs', 'Api\DevoirController@exams');
Route::delete('/exams/{id}', 'Api\DevoirController@delete');
Route::put('/exams/{id}', 'Api\DevoirController@update');
//Absences
Route::get('/abscences', 'Api\AbscenceController@myabscences');
//Feeds
Route::get('/feeds', 'Api\FeedController@feeds');
Route::post('/feeds', 'Api\FeedController@add');
Route::get('/feeds/{slug}', 'Api\FeedController@singlefeed');
//Notes
Route::get('/notes', 'Api\NoteController@notes');
//Formations
Route::get('/formations', 'Api\FormationController@formations');
Route::post('/formations', 'Api\FormationController@add');
Route::put('/formations', 'Api\FormationController@progress');
Route::get('/formations/{slug}', 'Api\FormationController@singleformation');
Route::get('/{uuid}/view', 'Api\FormationController@view');
//Affectations
Route::get('/affectations', 'Api\AffectationController@affectations');

//Classes
Route::get('/classes', 'Api\ClasseController@classes');

//Niveaux
Route::get('/niveaux', 'Api\NiveauController@niveaux');

//Etudiants
Route::get('/etudiants', 'Api\EtudiantController@etudiants');
Route::get('/etudiants/niveau/{niveau_id}', 'Api\EtudiantController@etudiantsbyniveau');

//Professeurs
Route::get('/professeurs', 'Api\ProfesseurController@professeurs');
//Utilisateur
Route::get('/users/{cin}', 'Api\ProfileController@getUser');
