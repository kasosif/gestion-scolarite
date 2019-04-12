<?php

namespace App\Http\Controllers;


use App\Http\Requests\SpecialiteRequest;
use App\Model\Annee;
use App\Model\Specialite;

class SpecialiteController extends Controller
{
    /**
     * Display a listing of Specialties
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $specialites = Specialite::all();
        return view('Specialites.index',['specialites'=>$specialites]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $annees = Annee::all();
        return view('Specialites.ajout',compact('annees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SpecialiteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SpecialiteRequest $request)
    {
        Specialite::create($request->all());
        return redirect()->route('specialite.index')->with('success','Specialité Ajoutée');
    }


    /**
     * Show the infos about a certain resource
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $specialite = Specialite::findorFail($id);
        return view('Specialites.show',compact('specialite'));
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
        $specialite = Specialite::findorFail($id);
        return view('Specialites.modif',compact('specialite','annees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  SpecialiteRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SpecialiteRequest $request, $id)
    {
        $specialite = Specialite::findorFail($id);
        $specialite->update($request->all());
        return redirect()->route('specialite.index')->with('success','Specialité Modifiée');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $specialite = Specialite::findorFail($id);
        $specialite->delete();
        return redirect()->route('specialite.index')->with('success','Specialité Supprimée');
    }
}
