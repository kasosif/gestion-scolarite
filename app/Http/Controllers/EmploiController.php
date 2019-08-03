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
use App\Notifications\ScheduleModified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class EmploiController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(){
        $this->authorize('view', Emploi::class);
        $classes = DB::table('classes')
            ->select('annees.id as annee_id','annees.nom','annees.date_debut','annees.date_fin','classes.*')
            ->join('niveaux','classes.niveau_id','=','niveaux.id')
            ->join('specialites','niveaux.specialite_id','=','specialites.id')
            ->join('annees','specialites.annee_id','=','annees.id')
            ->get();
        $annees = Annee::all();
        return view('Emplois.index',compact('classes','annees'));
    }

    /**
     * @param $classe_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function emploisClasse($classe_id){
        $this->authorize('view', Emploi::class);
        $classe = Classe::find($classe_id);
        $emplois = DB::table('emplois')
            ->select('semaine','classe_id','date_debut','date_fin')
            ->distinct()
            ->where('classe_id',$classe_id)
            ->get();
        return view('Emplois.classe',compact('classe','emplois'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create() {
        $this->authorize('create', Emploi::class);
        $annees = Annee::all();
        return view('Emplois.create',compact('seances','jours','affectations','professeurs','salles','annees'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request) {
        $this->authorize('create', Emploi::class);
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
                }else{
                    $se= Seance::find($s->id);
                    $jou=Jour::find($j->id);
                    $emplois=new Emploi();

                    $emplois->classe_id = $classe->id;
                    $emplois->semaine  = $semaine;
                    $emplois->jour_id = $jou->id;
                    $emplois->date_debut = $dateD;
                    $emplois->date_fin = $dateF;
                    $emplois->seance_id  = $se->id;
                    $emplois->save();
                }
            }
        }
        return redirect()->route('emplois.classe',['classe_id'=>$classe->id])->with('success','Emploi ajoutée avec success');

    }

    /**
     * @param $classe_id
     * @param $dateD
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show($classe_id,$dateD)
    {
        $this->authorize('view', Emploi::class);
        $classe = Classe::find($classe_id);
        $jours = Jour::all();
        $seances = Seance::all();
        $dateD=new \DateTime($dateD);
        $pagination = Emploi::where('classe_id',$classe->id)->where('date_debut',$dateD)->orderBy('seance_id')->get();
        $dateF = new \DateTime($pagination[0]->date_fin);
        $titre_semaine = $pagination[0]->semaine;
        return view('Emplois.show', compact('pagination','jours','classe','dateD','dateF','seances','titre_semaine'));
    }

    /**
     * @param $classe_id
     * @param $dateD
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit($classe_id,$dateD){
        $this->authorize('update', Emploi::class);
        $classe = Classe::find($classe_id);
        $jours = Jour::all();
        $seances = Seance::all();
        $salles = Salle::all();
        $affectations = Affectation::where('classe_id',$classe->id)->get();
        $dateD=new \DateTime($dateD);
        $emplois = Emploi::where('classe_id',$classe->id)->where('date_debut',$dateD)->orderBy('seance_id')->get();
        $dateF = new \DateTime($emplois[0]->date_fin);
        $titre_semaine = $emplois[0]->semaine;
        return view('Emplois.edit', compact('emplois','affectations','salles','jours','classe','dateD','dateF','seances','titre_semaine'));

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request){
        $this->authorize('update', Emploi::class);
        $jours = Jour::all();
        $seances = Seance::all();
        $select=$request->get('mat');
        $salle=$request->get('salle');
        $classe=Classe::find($request->get('classe_id'));
        $semaine=$request->get('semaine');
        $dateD=$request->get('date_debut');
        $dateF=$request->get('date_fin');
        DB::table('emplois')->where('classe_id',$classe->id)->where('date_debut',$dateD)->delete();
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
                }else{
                    $se= Seance::find($s->id);
                    $jou=Jour::find($j->id);
                    $emplois=new Emploi();

                    $emplois->classe_id = $classe->id;
                    $emplois->semaine  = $semaine;
                    $emplois->jour_id = $jou->id;
                    $emplois->date_debut = $dateD;
                    $emplois->date_fin = $dateF;
                    $emplois->seance_id  = $se->id;
                    $emplois->save();
                }
            }
        }
        foreach ($classe->users as $user) {
            $user->notify(new ScheduleModified('icon-grid text-warning', $dateD. ' => '.$dateF, 'Emploi Modifié'));
        }
        return redirect()->route('emplois.classe',['classe_id'=>$classe->id])->with('success','Emploi modifié avec success');
    }

    /**
     * @param $classe_id
     * @param $dateD
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */

    public function printWeek($classe_id,$dateD)
    {
        $this->authorize('view', Emploi::class);
        $classe = Classe::find($classe_id);
        $jours = Jour::all();
        $seances = Seance::all();
        $dateD=new \DateTime($dateD);
        $pagination = Emploi::where('classe_id',$classe->id)->where('date_debut',$dateD)->orderBy('seance_id')->get();
        $dateF = new \DateTime($pagination[0]->date_fin);
        $titre_semaine = $pagination[0]->semaine;
        $pdf = PDF::loadView('docs.emploisemaine', compact('pagination','jours','classe','dateD','dateF','seances','titre_semaine'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download('emploi_classe_'.$classe->abbreviation.'_semaine_'.$dateD->format('d-m-Y').'_'.$dateF->format('d-m-Y').'pdf');


    }

    /**
     * @param $classe_id
     * @param $dateD
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */

    public function destroy($classe_id,$dateD){
        $this->authorize('delete', Emploi::class);
        if ($classe_id && $dateD){
            DB::table('emplois')->where('classe_id',$classe_id)->where('date_debut',$dateD)->delete();
            return redirect()->route('emplois.classe',['classe_id'=>$classe_id])->with('success','Emploi Supprimé avec success');
        }
        return redirect()->route('emplois.classe',['classe_id'=>$classe_id])->with('erreur','Erreur d\'operation' );
    }




}
