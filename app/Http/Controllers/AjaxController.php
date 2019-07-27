<?php

namespace App\Http\Controllers;


use App\Model\Affectation;
use App\Model\Annee;
use App\Model\Classe;
use App\Model\Emploi;
use App\Model\Jour;
use App\Model\Matiere;
use App\Model\Niveau;
use App\Model\Salle;
use App\Model\Seance;
use App\Model\Specialite;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AjaxController extends Controller
{

    public function __construct()
    {
        $this->middleware('only.ajax');
    }

    /**
     * Display classes by speciality
     *
     * @param  int  $spec_id
     * @return \Illuminate\Http\Response
     */
    public function classsesBySpecialite($spec_id = null)
    {
        $spec = Specialite::findorFail($spec_id);
        return view('Ajax.classes',['spec'=>$spec]);
    }

    /**
     * Display all classes
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllClasses()
    {
        $classes = Classe::all();
        return view('Ajax.classesforfeed',['classes'=>$classes]);
    }

    /**
     * Display all students
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllStudents()
    {
        $etudiants = User::where('role','ROLE_ETUDIANT')->get();
        return view('Ajax.students',compact('etudiants'));
    }

    /**
     * Display students by classe
     * @param  int  $classe_id
     * @return \Illuminate\Http\Response
     */
    public function getStudentsByClasse($classe_id)
    {
        $classe = Classe::findOrFail($classe_id);
        $etudiants = $classe->users;
        return view('Ajax.students',compact('etudiants'));
    }

    /**
     * Display students by classe for Presence
     * @param  int  $classe_id
     * @return \Illuminate\Http\Response
     */
    public function getStudentsForPresence($classe_id)
    {
        $classe = Classe::findOrFail($classe_id);
        $etudiants = $classe->users;
        return view('Ajax.etudiantsabscence',compact('etudiants'));
    }

    /**
     * Display students by classe for Presence
     * @param  int  $classe_id
     * @return \Illuminate\Http\Response
     */
    public function getStudentsForMark($classe_id)
    {
        $classe = Classe::findOrFail($classe_id);
        $etudiants = $classe->users;
        return view('Ajax.etudiantsnote',compact('etudiants'));
    }

    /**
     * Display all teachers
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllTeachers()
    {
        $professeurs = User::where('role','ROLE_PROFESSEUR')->get();
        return view('Ajax.teachers',compact('professeurs'));
    }

    /**
     * Display classes by annee
     *
     * @param  int  $annee_id
     * @return \Illuminate\Http\Response
     */
    public function classsesByAnnee($annee_id = null)
    {
        $annee = Annee::findorFail($annee_id);
        $specialites = $annee->specialites;
        return view('Ajax.classesforemplois',['specialites'=>$specialites]);
    }

    /**
     * Display matieres by classe
     *
     * @param  int  $classe_id
     * @return \Illuminate\Http\Response
     */
    public function matieresByClasse($classe_id = null)
    {
        $classe = Classe::findorFail($classe_id);
        $niveau = $classe->niveau;
        $matieres = $niveau->matieres()->get();
        return view('Ajax.matieres',['matieres'=>$matieres]);
    }

    /**
     * Display devoirs by classe
     *
     * @param  int  $classe_id
     * @return \Illuminate\Http\Response
     */
    public function devoirsByClasse($classe_id = null)
    {
        $classe = Classe::findorFail($classe_id);
        $niveau = $classe->niveau;
        $matieres = $niveau->matieres()->get();
        return view('Ajax.devoirs',['matieres'=>$matieres]);
    }

    /**
     * Display dates for schedueles
     *
     * @param  int  $classe_id
     * @return \Illuminate\Http\Response
     */
    public function datesforEmploi($annee_id = null, $classe_id = null)
    {
        $annee = Annee::findorFail($annee_id);
        $emploi = Emploi::where('classe_id', $classe_id)->orderBy('date_fin', 'desc')->first();
        return view('Ajax.dates',compact('emploi','annee'));
    }

    /**
     * display proper schedule to fill
     *
     * @return \Illuminate\Http\Response
     */
    public function displayemploi(Request $request)
    {
        $annee = Annee::find($request->get('annee_id'));
        $classe = Classe::find($request->get('classe_id'));
        $semaine = $request->get('semaine');
        $date_debut = $request->get('date_debut');
        $date_fin = $request->get('date_fin');
        $validateddata = $request->validate([
            'semaine'=>['required',Rule::unique('emplois')->where('classe_id',$classe->id)],
            'annee_id' => 'required',
            'classe_id' => 'required',
            'date_debut' => 'required|date|before:date_fin',
            'date_fin' => 'required|date|before:'.$annee->date_fin,
        ]);
        $seances = Seance::all();
        $jours = Jour::all();
        $affectations = Affectation::where('classe_id',$classe->id)->get();
        $salles = Salle::all();
        return view('Ajax.emploi',compact(
            'seances','jours',
            'affectations','salles',
            'classe','annee',
            'date_debut','date_fin',
            'semaine'
        ));
    }



    /**
     * Display matieres by classe
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function affecterProfesseur(Request $request)
    {
        $classe = Classe::findorFail($request->get('classe_id'));
        $this->authorize('update',$classe);
        Affectation::create($request->all());
        $matiere = Matiere::findorFail($request->get('matiere_id'));
        $professeur= User::findorFail($request->get('user_id'));
        return response()->json([
            'matiere' => $matiere->nom,
            'professeur' => $professeur->nom.' '.$professeur->prenom
        ]);
    }

    public function displayparites($nb) {
        if ($nb > 10 ) {
            return 'Nombre maximum';
        }
        return view('Ajax.parties',compact('nb'));
    }
}
