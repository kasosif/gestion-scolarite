<?php

namespace App\Http\Controllers;


use App\Http\Requests\AbscenceRequest;
use App\Model\Abscence;
use App\Model\Annee;
use App\Model\Seance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbscenceController extends Controller
{
    /**
     * Display a listing of Years
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $annees = Annee::all();
        if($request->query->all()){
            $seance = $request->query->get('seance_id');
            $matiere = $request->query->get('matiere_id');
            $date = $request->query->get('date');
            $semestre = $request->query->get('semestre_id');
        }
        $abscences = Abscence::all();
        return view('Abscences.index',compact('annees','abscences'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $annees = Annee::all();
        $seances = Seance::all();
        return view('Abscences.ajout',compact('annees','seances'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AbscenceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AbscenceRequest $request)
    {
        $params = [];
        if ($image = $request->files->get('justification')) {
            $destinationPath = 'images/abscences/'; // upload path
            dd(date('YmdHis'));
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $params['justification'] = $profileImage;
        }
        Abscence::create(array_merge($request->all(), $params));
        return redirect()->route('abscence.index')->with('success','Abscence Ajoutée');
    }

}
