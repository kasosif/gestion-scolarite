<?php

namespace App\Http\Controllers;


use App\Http\Requests\SemestreRequest;
use App\Model\Semestre;

class SemestreController extends Controller
{
    /**
     * Display a listing of Semesters
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view', Semestre::class);
        $semestres = Semestre::all();
        return view('Semestres.index',['semestres'=>$semestres]);
    }

    /**
     * Show the form for creating a new resource.
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Semestre::class);
        return view('Semestres.ajout');
    }

    /**
     * Store a newly created resource in storage.
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @param  SemestreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SemestreRequest $request)
    {
        $this->authorize('create', Semestre::class);
        Semestre::create($request->all());
        return redirect()->route('semestre.index')->with('success','Semestre Ajouté');
    }


    /**
     * Show the infos about a certain resource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('view', Semestre::class);
        $semestre = Semestre::findorFail($id);
        return view('Semestres.show',compact('semestre'));
    }


    /**
     * Show the form for editing the specified resource.
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('update', Semestre::class);
        $semestre = Semestre::findorFail($id);
        return view('Semestres.modif',compact('semestre'));
    }

    /**
     * Update the specified resource in storage.
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @param  SemestreRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SemestreRequest $request, $id)
    {
        $this->authorize('update', Semestre::class);
        $semestre = Semestre::findorFail($id);
        $semestre->update($request->all());
        return redirect()->route('semestre.index')->with('success','Semestre Modifié');
    }


    /**
     * Remove the specified resource from storage.
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', Semestre::class);
        $semestre = Semestre::findorFail($id);
        $semestre->delete();
        return redirect()->route('semestre.index')->with('success','Semestre Supprimé');
    }
}
