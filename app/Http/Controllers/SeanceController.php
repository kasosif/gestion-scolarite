<?php

namespace App\Http\Controllers;


use App\Http\Requests\SeanceRequest;
use App\Model\Seance;

class SeanceController extends Controller
{
    /**
     * Display a listing of Seances
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seances = Seance::all();
        return view('Seances.index',['seances'=>$seances]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Seances.ajout');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SeanceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SeanceRequest $request)
    {
        Seance::create($request->all());
        return redirect()->route('seance.index')->with('success','Seance Ajouté');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $seance = Seance::findorFail($id);
        return view('Seances.modif',compact('seance'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  SeanceRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SeanceRequest $request, $id)
    {
        $seance = Seance::findorFail($id);
        $seance->update($request->all());
        return redirect()->route('seance.index')->with('success','Seance Modifié');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $seance = Seance::findorFail($id);
        $seance->delete();
        return redirect()->route('seance.index')->with('success','Seance Supprimé');
    }
}
