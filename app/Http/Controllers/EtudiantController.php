<?php

namespace App\Http\Controllers;

use App\Http\Requests\EtudiantRequest;
use App\Model\Annee;
use App\Model\Classe;
use App\Model\Specialite;
use App\Model\User;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EtudiantController extends Controller
{

    /**
     * Display a listing of years
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('viewEtudiant', User::class);
        $etudiants = User::where('role','ROLE_ETUDIANT')->get();
        return view('Etudiants.liste',['etudiants'=>$etudiants]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('createEtudiant', Auth::user());
        $annees = Annee::all();
        $specialites = Specialite::all();
        return view('Etudiants.ajout',compact('annees','specialites'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  EtudiantRequest  $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(EtudiantRequest $request)
    {
        $this->authorize('createEtudiant', Auth::user());
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
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit($cin)
    {
        $etudiant = User::where('cin',$cin)->first();
        $this->authorize('updateEtudiant', $etudiant);
        $annees = Annee::all();
        $specialites = Specialite::all();
        return view('Etudiants.modif',
            compact('annees','specialites',
                'etudiant')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EtudiantRequest $request
     * @param  string  $cin
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(EtudiantRequest $request, $cin)
    {
        $etudiant = User::where('cin',$cin)->first();
        $this->authorize('updateEtudiant',[Auth::user(),$etudiant]);
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
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy($cin)
    {
        $this->authorize('deleteEtudiant', Auth::user());
        $etudiant = User::where('cin',$cin)->first();
        if ($etudiant->image && file_exists(public_path().'/images/etudiants/'.$etudiant->image)) {
            unlink(public_path().'/images/etudiants/'.$etudiant->image);
        }
        $etudiant->delete();
        return redirect()->route('etudiant.index')->with('success','Etudiant Supprimé');
    }
}
