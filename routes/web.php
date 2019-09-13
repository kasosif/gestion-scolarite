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


Route::group(['middleware' => 'auth'], function() {

    //dashboard
    Route::get('/', 'HomeController@index')->name('home');

    //profile
    Route::get('/profile', 'HomeController@profile')->name('profile');
    Route::put('/profile/changepassword', 'HomeController@changepassword')->name('profile.changepassword');
    Route::put('/profile/update', 'HomeController@updateprofile')->name('profile.update');
    Route::patch('/profile/updatepicture', 'HomeController@updateprofilepicture')->name('profile.changepicture');

    //etudiants

    Route::get('/etudiants', 'EtudiantController@index')->name('etudiant.index');
    Route::get('/etudiants/ajout', 'EtudiantController@create')->name('etudiant.ajout');
    Route::post('/etudiants/store', 'EtudiantController@store')->name('etudiant.store');
    Route::get('/etudiants/edit/{cin}', 'EtudiantController@edit')->name('etudiant.edit');
    Route::get('/etudiants/show/{cin}', 'EtudiantController@show')->name('etudiant.show');
    Route::get('/etudiants/carte/{cin}', 'EtudiantController@generateCarte')->name('etudiant.carte');
    Route::get('/etudiants/attestaionpresence/{cin}', 'EtudiantController@generateAttestationPresence')->name('etudiant.attestaionpresence');
    Route::get('/etudiants/attestaionpresenceA/{cin}', 'EtudiantController@generateAttestationPresenceArabe')->name('etudiant.attestaionpresenceA');
    Route::get('/etudiants/attestaioninscription/{cin}', 'EtudiantController@generateAttestationInscription')->name('etudiant.attestaioninscription');
    Route::get('/etudiants/attestaioninscriptionA/{cin}', 'EtudiantController@generateAttestationInscriptionArabe')->name('etudiant.attestaioninscriptionA');
    Route::get('/etudiants/bulletin/{cin}/{semestre_id}', 'EtudiantController@generateBulletin')->name('etudiant.bulletin');
    Route::put('/etudiants/update/{cin}', 'EtudiantController@update')->name('etudiant.update');
    Route::delete('/etudiants/destroy/{cin?}', 'EtudiantController@destroy')->name('etudiant.destroy');

    //professeurs

    Route::get('/professeurs', 'ProfesseurController@index')->name('professeur.index');
    Route::get('/professeurs/ajout', 'ProfesseurController@create')->name('professeur.ajout');
    Route::post('/professeurs/store', 'ProfesseurController@store')->name('professeur.store');
    Route::delete('/professeurs/destroy/{cin?}', 'ProfesseurController@destroy')->name('professeur.destroy');
    Route::get('/professeurs/edit/{cin}', 'ProfesseurController@edit')->name('professeur.edit');
    Route::put('/professeurs/update/{cin}', 'ProfesseurController@update')->name('professeur.update');

    //employes

    Route::get('/employes', 'EmployeController@index')->name('employe.index');
    Route::get('/employes/ajout', 'EmployeController@create')->name('employe.ajout');
    Route::post('/employes/store', 'EmployeController@store')->name('employe.store');
    Route::delete('/employes/destroy/{cin?}', 'EmployeController@destroy')->name('employe.destroy');
    Route::get('/employes/edit/{cin}', 'EmployeController@edit')->name('employe.edit');
    Route::put('/employes/update/{cin}', 'EmployeController@update')->name('employe.update');

    //actualitées

    Route::get('/feeds', 'FeedController@index')->name('feed.index');
    Route::get('/feeds/ajout', 'FeedController@create')->name('feed.ajout');
    Route::post('/feeds/store', 'FeedController@store')->name('feed.store');
    Route::delete('/feeds/destroy/{id?}', 'FeedController@destroy')->name('feed.destroy');
    Route::get('/feeds/edit/{id}', 'FeedController@edit')->name('feed.edit');
    Route::put('/feeds/update/{id}', 'FeedController@update')->name('feed.update');

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
    Route::get('/matieres/show/{id}', 'MatiereController@show')->name('matiere.show');
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

    //notes

    Route::get('/notes/', 'NoteController@index')->name('note.index');
    Route::get('/notes/ajout', 'NoteController@create')->name('note.ajout');
    Route::post('/notes/store', 'NoteController@store')->name('note.store');
    Route::get('/notes/edit/{id}', 'NoteController@edit')->name('note.edit');
    Route::put('/notes/update/{id}', 'NoteController@update')->name('note.update');
    Route::delete('/notes/destroy/{id?}', 'NoteController@destroy')->name('note.destroy');

    //formations

    Route::get('/formations/', 'FormationController@index')->name('formation.index');
    Route::get('/formations/ajout', 'FormationController@create')->name('formation.ajout');
    Route::post('/formations/store', 'FormationController@store')->name('formation.store');
    Route::get('/formations/edit/{id}', 'FormationController@edit')->name('formation.edit');
    Route::get('/formations/show/{id}', 'FormationController@show')->name('formation.show');
    Route::get('/formations/view/{uuid}', 'FormationController@view')->name('formation.view');
    Route::put('/formations/update/{id}', 'FormationController@update')->name('formation.update');
    Route::delete('/formations/destroy/{id?}', 'FormationController@destroy')->name('formation.destroy');

    //abscences

    Route::get('/abscencesetudiant/', 'AbscenceController@index')->name('abscencesetudiant.index');
    Route::get('/abscencesetudiant/ajout', 'AbscenceController@create')->name('abscencesetudiant.ajout');
    Route::post('/abscencesetudiant/store', 'AbscenceController@store')->name('abscencesetudiant.store');
    Route::get('/abscencesetudiant/edit/{id}', 'AbscenceController@edit')->name('abscencesetudiant.edit');
    Route::put('/abscencesetudiant/update/{id}', 'AbscenceController@update')->name('abscencesetudiant.update');
    Route::delete('/abscencesetudiant/destroy/{id?}', 'AbscenceController@destroyEtudiant')->name('abscencesetudiant.destroy');
    Route::get('/abscencesprofesseur/', 'AbscenceController@indexProfesseur')->name('abscencesprofesseur.index');
    Route::get('/abscencesprofesseur/ajout', 'AbscenceController@createProfesseur')->name('abscencesprofesseur.ajout');
    Route::post('/abscencesprofesseur/store', 'AbscenceController@storeProfesseur')->name('abscencesprofesseur.store');
    Route::get('/abscencesprofesseur/edit/{id}', 'AbscenceController@editProfesseur')->name('abscencesprofesseur.edit');
    Route::put('/abscencesprofesseur/update/{id}', 'AbscenceController@updateProfesseur')->name('abscencesprofesseur.update');
    Route::delete('/abscencesprofesseur/destroy/{id?}', 'AbscenceController@destroyProfesseur')->name('abscencesprofesseur.destroy');

    //niveaux

    Route::get('/niveaux/', 'NiveauController@index')->name('niveau.index');
    Route::get('/niveaux/ajout', 'NiveauController@create')->name('niveau.ajout');
    Route::post('/niveaux/store', 'NiveauController@store')->name('niveau.store');
    Route::get('/niveaux/edit/{id}', 'NiveauController@edit')->name('niveau.edit');
    Route::get('/niveaux/show/{id}', 'NiveauController@show')->name('niveau.show');
    Route::put('/niveaux/update/{id}', 'NiveauController@update')->name('niveau.update');
    Route::delete('/niveaux/destroy/{id?}', 'NiveauController@destroy')->name('niveau.destroy');

    //emplois

    Route::get('/emplois/classes', 'EmploiController@index')->name('emplois.classes');
    Route::get('/emplois/classe/{classe_id}', 'EmploiController@emploisClasse')->name('emplois.classe');
    Route::get('/emplois/create', 'EmploiController@create')->name('emplois.create');
    Route::get('/emplois/printweek/{classe_id}/{dateD}', 'EmploiController@printWeek')->name('emplois.printweek');
    Route::get('/emplois/show/{classe_id}/{dateD}', 'EmploiController@show')->name('emplois.show');
    Route::get('/emplois/edit/{classe_id}/{dateD}', 'EmploiController@edit')->name('emplois.edit');
    Route::delete('/emplois/destroy/{classe_id?}/{dateD?}', 'EmploiController@destroy')->name('emplois.destroy');
    Route::post('/emplois/store', 'EmploiController@store')->name('emplois.store');
    Route::put('/emplois/update', 'EmploiController@update')->name('emplois.update');

    //demandes
    Route::get('/demandes/', 'DemandeController@index')->name('demande.index');
    Route::patch('/demandes/treat/{demande_id?}', 'DemandeController@treat')->name('demande.treat');
    Route::delete('/demandes/destroy/{demande_id?}', 'DemandeController@destroy')->name('demande.destroy');

    //ajax
    Route::get('/ajax/classes/{spec_id?}', 'AjaxController@classsesBySpecialite')->name('ajax.classesbyspec');
    Route::post('/ajax/affecterprofesseur', 'AjaxController@affecterProfesseur')->name('ajax.affectprof');
    Route::get('/ajax/annees/{annee_id?}', 'AjaxController@classsesByAnnee')->name('ajax.classesbyannee');
    Route::get('/ajax/matieres/{classe_id?}', 'AjaxController@matieresByClasse')->name('ajax.matieresbyclasse');
    Route::get('/ajax/allclasses', 'AjaxController@getAllClasses')->name('ajax.classes');
    Route::get('/ajax/alletudiants', 'AjaxController@getAllStudents')->name('ajax.students');
    Route::get('/ajax/etudiants/{classe_id?}', 'AjaxController@getStudentsByClasse')->name('ajax.studentsbyclass');
    Route::get('/ajax/etudiantsabscence/{classe_id?}', 'AjaxController@getStudentsForPresence')->name('ajax.etudaintsabscence');
    Route::get('/ajax/professeurabscence/{classe_id?}', 'AjaxController@getTeachersForPresence')->name('ajax.professeurabscence');
    Route::get('/ajax/etudiantsnote/{classe_id?}', 'AjaxController@getStudentsForMark')->name('ajax.etudaintsnotes');
    Route::get('/ajax/professeurs', 'AjaxController@getAllTeachers')->name('ajax.teachers');
    Route::get('/ajax/devoirs/{classe_id?}', 'AjaxController@devoirsByClasse')->name('ajax.devoirsbyclasse');
    Route::get('/ajax/datesemplois/{annee_id?}/{classe_id?}', 'AjaxController@datesforEmploi')->name('ajax.datesforemploi');
    Route::post('/ajax/displayemploi', 'AjaxController@displayemploi')->name('ajax.displayemploi');
    Route::get('/ajax/displayparites/{nb?}', 'AjaxController@displayparites')->name('ajax.displayparites');
});

