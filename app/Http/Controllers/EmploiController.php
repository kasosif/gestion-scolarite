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
    public function store(Request $request) {
        $jours = Jour::all();
        $seances = Seance::all();
        $select=$request->get('mat');
        $salle=$request->get('salle');
        $classe=Classe::find($request->get('classe_id'));
        $semaine=$request->get('semaine');
        $dateD=$request->get('date_debut');
        $dateF=$request->get('date_fin');
        foreach($jours as $j){
            foreach($seances as $s){
                if(isset($select[$j->id][$s->id]) && isset($salle[$j->id][$s->id])){
                    $id_matiere=$select[$j->id][$s->id];
                    $id_Salle=$salle[$j->id][$s->id];
                    $affect = Affectation::where('classe_id',$classe->id)->where('matiere_id',$id_matiere)->first();
                    $id_prof=$affect->user->id;
                    $mat=Matiere::find($id_matiere);
                    $sa=Salle::find($id_Salle);
                    $pro=User::find($id_prof);
                    $se= Seance::find($s->id);
                    $jou=Jour::find($j->id);
                    $emplois=new Emploi();

                    $emplois->classe_id = $classe->id;
                    $emplois->semaine  = $semaine;
                    $emplois->jour_id = $jou->id;
                    $emplois->matiere_id  = $mat->id;
                    $emplois->salle_id  = $sa->id;
                    $emplois->user_id  = $pro->id;
                    $emplois->date_debut = $dateD;
                    $emplois->date_fin = $dateF;
                    $emplois->seance_id  = $se->id;
                    $emplois->save();
                }
            }
        }
        return redirect()->route('emplois.classe',['classe_id'=>$classe->id])->with('success','Emploi ajoutée avec success');

    }
}
