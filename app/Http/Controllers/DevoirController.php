<?php

namespace App\Http\Controllers;


use App\Http\Requests\DevoirRequest;
use App\Model\Annee;
use App\Model\Classe;
use App\Model\Devoir;
use App\Model\Matiere;
use App\Model\Niveau;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DevoirController extends Controller
{
    /**
     * Display a listing of Devoirs
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view', Devoir::class);
        $devoirs = Devoir::all();
        return view('Devoirs.index',['devoirs'=>$devoirs]);
    }

    /**
     * Show the form for creating a new resource.
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Devoir::class);
        $niveaux = Niveau::all();
        $annee = DB::table('annees')
            ->select('annees.*')
            ->where('annees.date_debut','<',Carbon::today())
            ->where('annees.date_fin','>',Carbon::today())
            ->first();
        return view('Devoirs.ajout',compact('niveaux','annee'));
    }

    /**
     * Store a newly created resource in storage.
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @param  DevoirRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DevoirRequest $request)
    {
        $this->authorize('create', Devoir::class);
        Devoir::create($request->all());
        return redirect()->route('devoir.index')->with('success','Devoir Ajouté');
    }

    /**
     * Show the form for editing the specified resource.
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('update', Devoir::class);
        $niveaux = Niveau::all();
        $annee = DB::table('annees')
            ->select('annees.*')
            ->where('annees.date_debut','<',Carbon::today())
            ->where('annees.date_fin','>',Carbon::today())
            ->first();
        $devoir = Devoir::findorFail($id);
        return view('Devoirs.modif',compact('devoir','niveaux','annee'));
    }

    /**
     * Update the specified resource in storage.
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @param  DevoirRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DevoirRequest $request, $id)
    {
        $this->authorize('update', Devoir::class);
        $devoir = Devoir::findorFail($id);

        $devoir->update($request->all());
        return redirect()->route('devoir.index')->with('success','Devoir Modifié');
    }


    /**
     * Remove the specified resource from storage.
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', Devoir::class);
        $devoir = Devoir::findorFail($id);
        $devoir->delete();
        return redirect()->route('devoir.index')->with('success','Devoir Supprimé');
    }

}
