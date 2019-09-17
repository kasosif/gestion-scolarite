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
Route::get('/schedules', 'Api\EmploiController@schedules');
Route::post('/oneschedule', 'Api\EmploiController@oneschedule');
Route::post('/schedulePDF', 'Api\EmploiController@PDFschedule');
//Notifications
Route::get('/lastnotifs', 'Api\AuthController@lastnotifs');
Route::get('/notifs', 'Api\NotifController@notifs');
Route::patch('/notifs', 'Api\NotifController@allread');
Route::delete('/notifs/{id}', 'Api\NotifController@delete');
Route::delete('/notifs', 'Api\NotifController@deleteall');
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
Route::delete('/feeds/{slug}', 'Api\FeedController@deletefeed');
Route::post('/feeds/{id}', 'Api\FeedController@editfeed');
//Notes
Route::get('/notes', 'Api\NoteController@notes');
//Formations
Route::get('/formations', 'Api\FormationController@formations');
Route::post('/formations', 'Api\FormationController@add');
Route::put('/formations', 'Api\FormationController@progress');
Route::get('/formations/{slug}', 'Api\FormationController@singleformation');
Route::delete('/formations/{slug}', 'Api\FormationController@deleteformation');
Route::delete('/formations/deletepartie/{id}', 'Api\FormationController@deletepartie');
Route::post('/formations/edit/{id}', 'Api\FormationController@editformation');
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
