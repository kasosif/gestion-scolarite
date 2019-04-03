<?php

namespace App\Http\Controllers;


use App\Http\Requests\DevoirRequest;
use App\Model\Annee;
use App\Model\Classe;
use App\Model\Devoir;
use App\Model\Matiere;

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
        $annees = Annee::all();
        return view('Devoirs.ajout',compact('annees'));
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
        $annees = Annee::all();
        $devoir = Devoir::findorFail($id);
        return view('Devoirs.modif',compact('devoir','annees'));
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


    /**
     * Display classes by annee
     *
     * @param  int  $annee_id
     * @return \Illuminate\Http\Response
     */
    public function getclasses($annee_id = null)
    {
        $annee = Annee::findorFail($annee_id);
        $classes = $annee->classes()->get();
        return view('Devoirs.classes',['classes'=>$classes]);
    }

    /**
     * Display matieres by classe
     *
     * @param  int  $classe_id
     * @return \Illuminate\Http\Response
     */
    public function getmatieres($classe_id = null)
    {
        $classe = Classe::findorFail($classe_id);
        $matieres = $classe->matieres()->get();
        return view('Devoirs.matieres',['matieres'=>$matieres]);
    }
}
