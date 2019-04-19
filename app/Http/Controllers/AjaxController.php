<?php

namespace App\Http\Controllers;


use App\Model\Affectation;
use App\Model\Annee;
use App\Model\Classe;
use App\Model\Matiere;
use App\Model\Specialite;
use App\Model\User;
use Illuminate\Http\Request;

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
        $classes = $annee->classes()->get();
        return view('Ajax.classes',['classes'=>$classes]);
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
}
