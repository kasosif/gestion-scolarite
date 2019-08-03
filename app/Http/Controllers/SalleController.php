<?php

namespace App\Http\Controllers;

use App\Http\Requests\SalleRequest;
use App\Model\Salle;
class SalleController extends Controller
{
    /**
     * Display a listing of Salles
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view', Salle::class);
        $salles = Salle::all();
        return view('Salles.index',['salles'=>$salles]);
    }

    /**
     * Show the form for creating a new resource.
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Salle::class);
        return view('Salles.ajout');
    }

    /**
     * Store a newly created resource in storage.
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @param  SalleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SalleRequest $request)
    {
        $this->authorize('create', Salle::class);
        Salle::create($request->all());
        return redirect()->route('salle.index')->with('success','Salle Ajouté');
    }


    /**
     * Show the form for editing the specified resource.
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('update', Salle::class);
        $salle = Salle::findorFail($id);
        return view('Salles.modif',compact('salle'));
    }

    /**
     * Update the specified resource in storage.
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @param  SalleRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SalleRequest $request, $id)
    {
        $this->authorize('update', Salle::class);
        $salle = Salle::findorFail($id);
        $salle->update($request->all());
        return redirect()->route('salle.index')->with('success','Salle Modifié');
    }


    /**
     * Remove the specified resource from storage.
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', Salle::class);
        $salle = Salle::findorFail($id);
        $salle->delete();
        return redirect()->route('salle.index')->with('success','Salle Supprimé');
    }
}
