<?php

namespace App\Http\Controllers;


use App\Http\Requests\AbscenceProfesseurRequest;
use App\Http\Requests\AbscenceRequest;
use App\Model\Abscence;
use App\Model\Affectation;
use App\Model\Annee;
use App\Model\Seance;
use App\Model\User;
use App\Notifications\MissedAdded;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbscenceController extends Controller
{
    /**
     * Display a listing of Years
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request)
    {
        $this->authorize('viewEtudiant', Abscence::class);
        $annees = Annee::all();
        $abscences = Abscence::whereNull('classe_id')->get();
        if ($user_id = $request->query('user_id')) {
            $query = Abscence::where('user_id',$user_id);
            if ($date = $request->query('date'))
                $query = $query->where('date','=',$date);
            $abscences = $query->get();
        }
        return view('Abscences.index',compact('abscences','annees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('createEtudiant', Abscence::class);
        $annees = Annee::all();
        $seances = Seance::all();
        return view('Abscences.ajout',compact('annees','seances'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AbscenceRequest  $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(AbscenceRequest $request)
    {
        $this->authorize('createEtudiant', Abscence::class);
        foreach ($request->get('abscences') as $user){
            $justifie = false;
            if ($request->get('justifie')){
                if (in_array($user,$request->get('justifie')))
                    $justifie = true;
            }
            $abscence = Abscence::create([
                'date' => $request->get('date'),
                'justifie' => $justifie,
                'user_id' => $user,
                'matiere_id' => $request->get('matiere_id'),
                'seance_id' => $request->get('seance_id'),
            ]);
            $abscence->user->notify(new MissedAdded('icon-clock', $abscence->seance, 'Vous étiez absent le '.$request->get('date'),'/app/abscences'));
        }
        return redirect()->route('abscencesetudiant.index')->with('success','Abscence(s) Ajoutée');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroyEtudiant($id)
    {
        $abscence = Abscence::findorFail($id);
        $this->authorize('deleteEtudiant', $abscence);
        $abscence->delete();
        return redirect()->route('abscencesetudiant.index')->with('success','Abscence Supprimé');
    }


    /**
     * Display a listing of Years
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function indexProfesseur(Request $request)
    {
        $this->authorize('viewProfesseur', Abscence::class);
        $abscences = Abscence::whereNotNull('classe_id')->get();
        return view('Abscences.index',compact('abscences'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function createProfesseur()
    {
        $this->authorize('createProfesseur', Abscence::class);
        $annees = Annee::all();
        $seances = Seance::all();
        return view('Abscences.ajoutProfesseur',compact('annees','seances'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AbscenceProfesseurRequest  $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function storeProfesseur(AbscenceProfesseurRequest $request)
    {
        $this->authorize('createProfesseur', Abscence::class);
        foreach ($request->get('abscences') as $user){
            $justifie = false;
            if ($request->get('justifie')){
                if (in_array($user,$request->get('justifie')))
                    $justifie = true;
            }
            $abscence = Abscence::create([
                'date' => $request->get('date'),
                'justifie' => $justifie,
                'user_id' => $user,
                'matiere_id' => Affectation::where('classe_id',$request->get('classe_id'))->where('user_id',$user)->first()->matiere_id,
                'seance_id' => $request->get('seance_id'),
                'classe_id' => $request->get('classe_id'),
            ]);
            $abscence->user->notify(new MissedAdded('icon-clock', $abscence->seance, 'Vous étiez absent le '.$request->get('date'),'/app/abscences',$abscence->classe));
        }
        return redirect()->route('abscencesprofesseur.index')->with('success','Abscence(s) Ajoutée');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroyProfesseur($id)
    {
        $abscence = Abscence::findorFail($id);
        $this->authorize('deleteProfesseur', $abscence);
        $abscence->delete();
        return redirect()->route('abscencesprofesseur.index')->with('success','Abscence Supprimé');
    }

}
