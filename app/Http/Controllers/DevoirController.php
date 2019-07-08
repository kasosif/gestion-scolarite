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
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $devoirs = Devoir::all();
        return view('Devoirs.index',['devoirs'=>$devoirs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
     *
     * @param  DevoirRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DevoirRequest $request)
    {
        Devoir::create($request->all());
        return redirect()->route('devoir.index')->with('success','Devoir Ajouté');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
     *
     * @param  DevoirRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DevoirRequest $request, $id)
    {
        $devoir = Devoir::findorFail($id);

        $devoir->update($request->all());
        return redirect()->route('devoir.index')->with('success','Devoir Modifié');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $devoir = Devoir::findorFail($id);
        $devoir->delete();
        return redirect()->route('devoir.index')->with('success','Devoir Supprimé');
    }

}
