<?php

namespace App\Http\Controllers;

use App\Http\Requests\NiveauRequest;
use App\Model\Matiere;
use App\Model\Niveau;
use App\Model\Specialite;

class NiveauController extends Controller
{
    /**
     * Display a listing of Niveaux
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view', Niveau::class);
        $niveaux = Niveau::all();
        return view('Niveaux.index',['niveaux'=>$niveaux]);
    }

    /**
     * Show the form for creating a new resource.
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Niveau::class);
        $matieres = Matiere::whereNull('niveau_id')->get();
        $specs = Specialite::all();
        return view('Niveaux.ajout',compact('matieres','specs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  NiveauRequest  $request
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @return \Illuminate\Http\Response
     */
    public function store(NiveauRequest $request)
    {
        $this->authorize('create', Niveau::class);
        $niveau = Niveau::create($request->except('matieres'));
        if ($request->get('matieres')){
            $matiereModels = [];
            foreach ($request->get('matieres') as $matiere) {
                $matiereModels[] = Matiere::find($matiere);
            }
            $niveau->matieres()->saveMany($matiereModels);
        }
        return redirect()->route('niveau.index')->with('success','Niveau Ajoutée');
    }


    /**
     * Show the infos about a certain resource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $niveau = Niveau::findorFail($id);
        $this->authorize('view', $niveau);
        return view('Niveaux.show',compact('niveau'));
    }


    /**
     * Show the form for editing the specified resource.
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $niveau = Niveau::findorFail($id);
        $this->authorize('update', $niveau);
        $matieres = Matiere::where('niveau_id',$niveau->id)->orWhereNull('niveau_id')->get();
        $specs = Specialite::all();
        return view('Niveaux.modif',compact('niveau','matieres','specs'));
    }

    /**
     * Update the specified resource in storage.
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @param  NiveauRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NiveauRequest $request, $id)
    {
        $niveau = Niveau::findorFail($id);
        $this->authorize('update', $niveau);
        $niveau->update($request->except('matieres'));

        Matiere::where('niveau_id',$niveau->id)->update(['niveau_id'=>null]);
        if ($request->get('matieres')){
            $matiereModels = [];
            foreach ($request->get('matieres') as $matiere) {
                $matiereModels[] = Matiere::find($matiere);
            }
            $niveau->matieres()->saveMany($matiereModels);
        }
        return redirect()->route('niveau.index')->with('success','Niveau Modifiée');
    }


    /**
     * Remove the specified resource from storage.
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $niveau = Niveau::findorFail($id);
        $this->authorize('delete', $niveau);
        $niveau->delete();
        return redirect()->route('niveau.index')->with('success','Niveau Supprimée');
    }
}
