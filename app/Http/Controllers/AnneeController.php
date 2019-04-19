<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnneeRequest;
use App\Model\Annee;

class AnneeController extends Controller
{
    /**
     * Display a listing of Years
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('view',Annee::class);
        $annees = Annee::all();
        return view('Annees.index',['annees'=>$annees]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('create',Annee::class);
        return view('Annees.ajout');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AnneeRequest  $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(AnneeRequest $request)
    {
        $this->authorize('create',Annee::class);
        Annee::create($request->all());
        return redirect()->route('annee.index')->with('success','Année Scolaire Ajoutée');
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
        $annee = Annee::findorFail($id);
        $this->authorize('view',$annee);
        return view('Annees.show',compact('annee'));
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
        $annee = Annee::findorFail($id);
        $this->authorize('update',$annee);
        return view('Annees.modif',compact('annee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AnneeRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(AnneeRequest $request, $id)
    {
        $annee = Annee::findorFail($id);
        $this->authorize('update',$annee);
        $annee->update($request->all());
        return redirect()->route('annee.index')->with('success','Année Scolaire Modifiée');
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
        $annee = Annee::findorFail($id);
        $this->authorize('delete',Annee::class);
        $annee->delete();
        return redirect()->route('annee.index')->with('success','Année Scolaire Supprimée');
    }
}
