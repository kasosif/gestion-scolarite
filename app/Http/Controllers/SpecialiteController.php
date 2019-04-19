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
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('view',Specialite::class);
        $specialites = Specialite::all();
        return view('Specialites.index',['specialites'=>$specialites]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('create',Specialite::class);
        $annees = Annee::all();
        return view('Specialites.ajout',compact('annees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SpecialiteRequest  $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(SpecialiteRequest $request)
    {
        $this->authorize('create',Specialite::class);
        Specialite::create($request->all());
        return redirect()->route('specialite.index')->with('success','Specialité Ajoutée');
    }


    /**
     * Show the infos about a certain resource
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show($id)
    {
        $specialite = Specialite::findorFail($id);
        $this->authorize('view',$specialite);
        return view('Specialites.show',compact('specialite'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit($id)
    {
        $annees = Annee::all();
        $specialite = Specialite::findorFail($id);
        $this->authorize('update',$specialite);
        return view('Specialites.modif',compact('specialite','annees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  SpecialiteRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(SpecialiteRequest $request, $id)
    {
        $specialite = Specialite::findorFail($id);
        $specialite->update($request->all());
        $this->authorize('update',$specialite);
        return redirect()->route('specialite.index')->with('success','Specialité Modifiée');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy($id)
    {
        $specialite = Specialite::findorFail($id);
        $this->authorize('delete',$specialite);
        $specialite->delete();
        return redirect()->route('specialite.index')->with('success','Specialité Supprimée');
    }
}
