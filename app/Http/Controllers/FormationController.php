<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormationRequest;
use App\Model\Classe;
use App\Model\Formation;
use App\Model\Niveau;
use App\Model\PartieFormation;
use App\Model\User;
use App\Notifications\FormationAdded;
use Illuminate\Support\Facades\Storage;
use Webpatser\Uuid\Uuid;

class FormationController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index() {
        $this->authorize('view', Formation::class);
        $formations = Formation::all();
        return view('Formations.index',compact('formations'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create() {
        $this->authorize('create', Formation::class);
        $users = User::where('role', 'ROLE_PROFESSEUR')->get();
        $niveaux = Niveau::all();
        return view('Formations.ajout', compact('users','niveaux'));
    }

    /**
     * @param FormationRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \getid3_exception
     */
    public function store(FormationRequest $request) {
        $this->authorize('create', Formation::class);
        $params = [];
        if ($image = $request->files->get('image')) {
            $destinationPath = 'images/formations/'; // upload path
            $formationImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $formationImage);
            $params['image'] = $formationImage;
        }
        $formation = Formation::create(array_merge($request->except('partie'),$params));
        $duration = 0;
        for ($i = 1; $i < count($request->get('partie')) + 1; $i++) {
            $partie = new PartieFormation();
            $partie->titre = $request->get('partie')[$i]['titre'];
            $partie->indice = $i;
            $partie->cover = date('YmdHis') . "." .$request->files->get('partie')[$i]['video']->getClientOriginalName();
            $request->partie[$i]['video']->storeAs('formations', $partie->cover);
            $partie->uuid = (string)Uuid::generate();
            $getID3 = new \getID3;
            $file = $getID3->analyze(storage_path('app/formations/'.$partie->cover));
            $playtime_seconds = $file['playtime_seconds'];
            $duration = $duration + $playtime_seconds;
            $partie->formation_id = $formation->id;
            $partie->save();
        }
        $formation->duration = $duration;
        $formation->save();
        $classes = Classe::where('niveau_id','=',$request->get('niveau_id'))->get();
        foreach ($classes as $classe) {
            foreach ($classe->users as $user) {
                $user->notify(
                        new FormationAdded(
                            'fa fa-play text-success',
                            $formation,
                            'Nouvelle Formation disponible',
                            '/app/formations'
                        )
                    );
            }
        }
        return redirect()->route('formation.index')->with('success','Formation Ajoutée');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */

    public function edit($id) {
        $this->authorize('update', Formation::class);
        $formation = Formation::findOrFail($id);
        $users = User::where('role', 'ROLE_PROFESSEUR')->get();
        $niveaux = Niveau::all();
        return view('Formations.modif', compact('formation','users','niveaux'));
    }

    /**
     * @param $id
     * @param FormationRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \getid3_exception
     */

    public function update($id, FormationRequest $request) {
        $this->authorize('update', Formation::class);
        $formation = Formation::findOrFail($id);
        $params = [];
        if ($image = $request->files->get('image')) {
            $destinationPath = 'images/formations/'; // upload path
            if ($formation->image && file_exists(public_path().'/images/formations/'.$formation->image)) {
                unlink(public_path().'/images/formations/'.$formation->image);
            }
            $formationImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $formationImage);
            $params['image'] = $formationImage;
        }
        $formation->update(array_merge($request->except('partie','oldpartie'),$params));
        if ($request->files->get('oldpartie')) {
            foreach ($request->get('oldpartie') as $key => $part) {
                $choisie = PartieFormation::where('formation_id',$id)
                    ->where('indice',$key)
                    ->first();
                $choisie->progressionetudiants()->delete();
                $getID3 = new \getID3;
                $file = $getID3->analyze(storage_path('app/formations/'.$choisie->cover));
                $playtime_seconds = $file['playtime_seconds'];
                $formation->duration -= $playtime_seconds;
                Storage::delete('formations/'.$choisie->cover);
                $choisie->titre = $request->get('oldpartie')[$key]['titre'];
                $choisie->cover = date('YmdHis') . "." .$request->files->get('oldpartie')[$key]['video']->getClientOriginalName();
                $request->oldpartie[$key]['video']->storeAs('formations', $choisie->cover);
                $file = $getID3->analyze(storage_path('app/formations/'.$choisie->cover));
                $playtime_seconds = $file['playtime_seconds'];
                $formation->duration+= $playtime_seconds;
                $choisie->save();
            }
            $formation->save();
        }
        if ($request->files->get('partie')) {
            for ($i = 1; $i < count($request->get('partie')) + 1; $i++) {
                $partie = new PartieFormation();
                $partie->titre = $request->get('partie')[$i]['titre'];
                $partie->indice = $formation->partieformations->count() + 1;
                $partie->cover = date('YmdHis') . "." .strtolower($request->files->get('partie')[$i]['video']->getClientOriginalName());
                $request->partie[$i]['video']->storeAs('formations', $partie->cover);
                $partie->uuid = (string)Uuid::generate();
                $getID3 = new \getID3;
                $file = $getID3->analyze(storage_path('app/formations/'.$partie->cover));
                $playtime_seconds = $file['playtime_seconds'];
                $formation->duration = $formation->duration + $playtime_seconds;
                $partie->formation_id = $formation->id;
                $partie->save();
            }
            $formation->save();
        }
        return redirect()->route('formation.index')->with('success','Formation Modifiée');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy($id)
    {
        $this->authorize('delete', Formation::class);
        $formation = Formation::findorFail($id);
        if ($formation->image && file_exists(public_path().'/images/formations/'.$formation->image)) {
            unlink(public_path().'/images/formations/'.$formation->image);
        }
        if ($formation->partieformations) {
            foreach ($formation->partieformations as $partiesformation) {
                Storage::delete('formations/'.$partiesformation->cover);
                $partiesformation->delete();
            }
        }
        $formation->delete();
        return redirect()->route('formation.index')->with('success','Formation Supprimée');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \getid3_exception
     */
    public function deletepartie($id) {
        $this->authorize('delete', Formation::class);
        $choisie = PartieFormation::where('uuid',$id)->first();
        $formation = $choisie->formation;
        $parties = $formation->partieformations()->orderBy('indice')->get();
        foreach ($parties as $partie) {
            if ($partie->indice > $choisie->indice) {
                $partie->indice--;
                $partie->save();
            }
        }
        $getID3 = new \getID3;
        $file = $getID3->analyze(storage_path('app/formations/'.$choisie->cover));
        $playtime_seconds = $file['playtime_seconds'];
        $formation->duration -= $playtime_seconds;
        Storage::delete('formations/'.$choisie->cover);
        $choisie->delete();
        $formation->save();
        return redirect()->route('formation.edit',['id'=>$formation->id])->with('success','Partie Supprimée');
    }

    public function view($uuid) {
        $partie = PartieFormation::where('uuid', $uuid)->firstOrFail();
        $pathToFile = storage_path('app/formations/' . $partie->cover);
        return response()->file($pathToFile);
    }


}
