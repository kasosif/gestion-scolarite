<?php

namespace App\Http\Controllers;


use App\Http\Requests\ClasseRequest;
use App\Model\Annee;
use App\Model\Classe;
use App\Model\Specialite;

class ClasseController extends Controller
{
    /**
     * Display a listing of Classes
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = Classe::all();
        return view('Classes.index',['classes'=>$classes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $annees = Annee::all();
        $specialites = Specialite::all();
        return view('Classes.ajout',compact('annees','specialites'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ClasseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClasseRequest $request)
    {
        Classe::create($request->all());
        return redirect()->route('classe.index')->with('success','Classe Ajoutée');
    }


    /**
     * Show the infos about a certain resource
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $classe = Classe::findorFail($id);
        return view('Classes.show',compact('classe'));
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
        $specialites = Specialite::all();
        $classe = Classe::findorFail($id);
        return view('Classes.modif',compact('classe','annees','specialites'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ClasseRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClasseRequest $request, $id)
    {
        $classe = Classe::findorFail($id);
        $classe->update($request->all());
        return redirect()->route('classe.index')->with('success','Classe Modifiée');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $classe = Classe::findorFail($id);
        $classe->delete();
        return redirect()->route('classe.index')->with('success','Classe Supprimée');
    }
}
