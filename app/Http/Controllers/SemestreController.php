<?php

namespace App\Http\Controllers;


use App\Http\Requests\SemestreRequest;
use App\Model\Semestre;

class SemestreController extends Controller
{
    /**
     * Display a listing of Semesters
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $semestres = Semestre::all();
        return view('Semestres.index',['semestres'=>$semestres]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Semestres.ajout');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SemestreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SemestreRequest $request)
    {
        Semestre::create($request->all());
        return redirect()->route('semestre.index')->with('success','Semestre Ajouté');
    }


    /**
     * Show the infos about a certain resource
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $semestre = Semestre::findorFail($id);
        return view('Semestres.show',compact('semestre'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $semestre = Semestre::findorFail($id);
        return view('Semestres.modif',compact('semestre'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  SemestreRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SemestreRequest $request, $id)
    {
        $semestre = Semestre::findorFail($id);
        $semestre->update($request->all());
        return redirect()->route('semestre.index')->with('success','Semestre Modifié');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $semestre = Semestre::findorFail($id);
        $semestre->delete();
        return redirect()->route('semestre.index')->with('success','Semestre Supprimé');
    }
}
