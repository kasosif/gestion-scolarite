<?php

namespace App\Http\Controllers;

use App\Http\Requests\EtudiantRequest;
use App\Model\Annee;
use App\Model\Classe;
use App\Model\Specialite;
use App\Model\User;
use File;
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
        $classes = $spec->classes()->get();
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
        return view('Etudiants.liste',['annee'=>$annee]);
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
     * @param  EtudiantRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EtudiantRequest $request)
    {
        $params = ['role' => 'ROLE_ETUDIANT'];
        if ($image = $request->files->get('image')) {
            $destinationPath = 'images/etudiants/'; // upload path
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $params['image'] = $profileImage;
        }
        User::create(array_merge($request->all(), $params));
        return redirect()->route('etudiant.index')->with('success','Etudiant Ajouté');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $cin
     * @return \Illuminate\Http\Response
     */
    public function edit($cin)
    {
        $etudiant = User::where('cin',$cin)->first();
        $maclasse = Classe::findorFail($etudiant->classe_id);
        $monannee = Annee::findorFail($maclasse->annee_id);
        $maspecialite = Specialite::findorFail($maclasse->specialite_id);
        $annees = Annee::all();
        $specialites = Specialite::all();
        return view('Etudiants.modif',
            compact('annees',
                'specialites',
                'etudiant','monannee','maspecialite','maclasse')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EtudiantRequest $request
     * @param  string  $cin
     * @return \Illuminate\Http\Response
     */
    public function update(EtudiantRequest $request, $cin)
    {
        $etudiant = User::where('cin',$cin)->first();
        $params = [];
        if ($image = $request->files->get('image')) {
            $destinationPath = 'images/etudiants/'; // upload path
            if ($etudiant->image && file_exists(public_path().'/images/etudiants/'.$etudiant->image)) {
                unlink(public_path().'/images/etudiants/'.$etudiant->image);
            }
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $params['image'] = $profileImage;
        }
        $etudiant->update(array_merge($request->all(),$params));
        return redirect()->route('etudiant.index')->with('success','Etudiant Modifié');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $cin
     * @return \Illuminate\Http\Response
     */
    public function destroy($cin)
    {
        $etudiant = User::where('cin',$cin)->first();
        if ($etudiant->image && file_exists(public_path().'/images/etudiants/'.$etudiant->image)) {
            unlink(public_path().'/images/etudiants/'.$etudiant->image);
        }
        $etudiant->delete();
        return redirect()->route('etudiant.index')->with('success','Etudiant Supprimé');
    }
}
