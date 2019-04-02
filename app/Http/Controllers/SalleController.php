<?php

namespace App\Http\Controllers;

use App\Http\Requests\SalleRequest;
use App\Model\Salle;
class SalleController extends Controller
{
    /**
     * Display a listing of Salles
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salles = Salle::all();
        return view('Salles.index',['salles'=>$salles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Salles.ajout');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SalleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SalleRequest $request)
    {
        Salle::create($request->all());
        return redirect()->route('salle.index')->with('success','Salle Ajouté');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $salle = Salle::findorFail($id);
        return view('Salles.modif',compact('salle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  SalleRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SalleRequest $request, $id)
    {
        $salle = Salle::findorFail($id);
        $salle->update($request->all());
        return redirect()->route('salle.index')->with('success','Salle Modifié');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $salle = Salle::findorFail($id);
        $salle->delete();
        return redirect()->route('salle.index')->with('success','Salle Supprimé');
    }
}
