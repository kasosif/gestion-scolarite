<?php

namespace App\Http\Controllers;


use App\Http\Requests\SeanceRequest;
use App\Model\Seance;

class SeanceController extends Controller
{
    /**
     * Display a listing of Seances
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view', Seance::class);
        $seances = Seance::all();
        return view('Seances.index',['seances'=>$seances]);
    }

    /**
     * Show the form for creating a new resource.
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Seance::class);
        return view('Seances.ajout');
    }

    /**
     * Store a newly created resource in storage.
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @param  SeanceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SeanceRequest $request)
    {
        $this->authorize('create', Seance::class);
        Seance::create($request->all());
        return redirect()->route('seance.index')->with('success','Seance Ajouté');
    }


    /**
     * Show the form for editing the specified resource.
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('update', Seance::class);
        $seance = Seance::findorFail($id);
        return view('Seances.modif',compact('seance'));
    }

    /**
     * Update the specified resource in storage.
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @param  SeanceRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SeanceRequest $request, $id)
    {
        $this->authorize('update', Seance::class);
        $seance = Seance::findorFail($id);
        $seance->update($request->all());
        return redirect()->route('seance.index')->with('success','Seance Modifié');
    }


    /**
     * Remove the specified resource from storage.
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', Seance::class);
        $seance = Seance::findorFail($id);
        $seance->delete();
        return redirect()->route('seance.index')->with('success','Seance Supprimé');
    }
}
