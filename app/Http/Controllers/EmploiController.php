<?php

namespace App\Http\Controllers;

use App\Model\Affectation;
use App\Model\Annee;
use App\Model\Classe;
use App\Model\Emploi;
use App\Model\Jour;
use App\Model\Matiere;
use App\Model\Salle;
use App\Model\Seance;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmploiController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(){
        $classes = DB::table('classes')
            ->select('annees.id as annee_id','annees.nom','annees.date_debut','annees.date_fin','classes.*')
            ->join('niveaux','classes.niveau_id','=','niveaux.id')
            ->join('specialites','niveaux.specialite_id','=','specialites.id')
            ->join('annees','specialites.annee_id','=','annees.id')
            ->get();
        $annees = Annee::all();
        return view('Emplois.index',compact('classes','annees'));
    }

    public function emploisClasse($classe_id){
        $classe = Classe::find($classe_id);
        $emplois = DB::table('emplois')
            ->select('semaine','classe_id','date_debut','date_fin')
            ->distinct()
            ->where('classe_id',$classe_id)
            ->get();
        return view('Emplois.classe',compact('classe','emplois'));
    }

    public function create() {
        $annees = Annee::all();
        $seances = Seance::all();
        $jours = Jour::all();
        $affectations = Affectation::where('classe_id',22)->get();
        $salles = Salle::all();
        return view('Emplois.create',compact('seances','jours','affectations','professeurs','salles','annees'));
    }
}
