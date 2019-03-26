<?php

namespace App\Http\Controllers;

use App\Model\Annee;
use App\Model\Classe;
use App\Model\Specialite;
use Illuminate\Http\Request;

class EtudiantController extends Controller
{

    /**
     * Display classes by speciality
     *
     * @param  int  $spec_id
     * @return \Illuminate\Http\Response
     */
    public function getclasses($spec_id = null)
    {
        $spec = Specialite::findorFail($spec_id);
        $classes = $spec->mesclasses()->get();
        return view('Etudiants.classes',['classes'=>$classes]);
    }

    /**
     * Display a listing of years
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $annees = Annee::paginate(4);
        return view('Etudiants.annees',['annees'=>$annees]);
    }

    /**
     * Display a listing of students
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function list($id)
    {
        $annee = Annee::findorFail($id);
        $classes = $annee->mesclasses()->get();
        return view('Etudiants.liste',['classes'=>$classes, 'annee'=>$annee]);
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
        return view('Etudiants.ajout',compact('annees','specialites'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
