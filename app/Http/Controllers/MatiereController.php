<?php

namespace App\Http\Controllers;


use App\Http\Requests\MatiereRequest;
use App\Model\Annee;
use App\Model\Matiere;
use App\Model\Semestre;
use App\Model\User;

class MatiereController extends Controller
{
    /**
     * Display a listing of Matieres
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $matieres = Matiere::all();
        return view('Matieres.index',['matieres'=>$matieres]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $annees = Annee::all();
        $semestres = Semestre::all();
        $professeurs = User::where('role','ROLE_PROFESSEUR')->get();
        return view('Matieres.ajout',compact(
            'annees','semestres','professeurs'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  MatiereRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MatiereRequest $request)
    {
        Matiere::create($request->all());
        return redirect()->route('matiere.index')->with('success','Matiere Ajouté');
    }


    /**
     * Show the infos about a certain resource
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $matiere = Matiere::findorFail($id);
        return view('Matieres.show',compact('matiere'));
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
        $semestres = Semestre::all();
        $professeurs = User::where('role','ROLE_PROFESSEUR')->get();
        $matiere = Matiere::findorFail($id);
        return view('Matieres.modif',compact(
            'matiere','annees','semestres','professeurs'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  MatiereRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MatiereRequest $request, $id)
    {
        $matiere = Matiere::findorFail($id);
        $matiere->update($request->all());
        return redirect()->route('matiere.index')->with('success','Matiere Modifié');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $matiere = Matiere::findorFail($id);
        $matiere->delete();
        return redirect()->route('matiere.index')->with('success','Matiere Supprimé');
    }
}
