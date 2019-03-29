<?php

namespace App\Http\Controllers;


use App\Http\Requests\ProfesseurRequest;
use App\Model\User;

class ProfesseurController extends Controller
{
    /**
     * Display a listing of Teachers
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $professeurs = User::where('role','ROLE_PROFESSEUR')->get();
        return view('Professeurs.index',['professeurs'=>$professeurs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Professeurs.ajout');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ProfesseurRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfesseurRequest $request)
    {
        $params = ['role' => 'ROLE_PROFESSEUR'];
        if ($image = $request->files->get('image')) {
            $destinationPath = 'images/professeurs/'; // upload path
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $params['image'] = $profileImage;
        }
        User::create(array_merge($request->all(), $params));
        return redirect()->route('professeur.index')->with('success','Professeur Ajouté');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $cin
     * @return \Illuminate\Http\Response
     */
    public function edit($cin)
    {
        $professeur = User::where('cin',$cin)->first();
        return view('Professeurs.modif',compact('professeur'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ProfesseurRequest $request
     * @param  string  $cin
     * @return \Illuminate\Http\Response
     */
    public function update(ProfesseurRequest $request, $cin)
    {
        $professeur = User::where('cin',$cin)->first();
        $params = [];
        if ($image = $request->files->get('image')) {
            $destinationPath = 'images/professeurs/'; // upload path
            if ($professeur->image && file_exists(public_path().'/images/professeurs/'.$professeur->image)) {
                unlink(public_path().'/images/professeurs/'.$professeur->image);
            }
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $params['image'] = $profileImage;
        }
        $professeur->update(array_merge($request->all(),$params));
        return redirect()->route('professeur.index')->with('success','Professeur Modifié');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $cin
     * @return \Illuminate\Http\Response
     */
    public function destroy($cin)
    {
        $professeur = User::where('cin',$cin)->first();
        if ($professeur->image && file_exists(public_path().'/images/professeurs/'.$professeur->image)) {
            unlink(public_path().'/images/professeurs/'.$professeur->image);
        }
        $professeur->delete();
        return redirect()->route('professeur.index')->with('success','Professeur Supprimé');
    }
}
