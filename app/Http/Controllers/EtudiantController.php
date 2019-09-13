<?php

namespace App\Http\Controllers;

use App\Http\Requests\EtudiantRequest;
use App\Mail\WelcomeMailWelearn;
use App\Model\Abscence;
use App\Model\Annee;
use App\Model\Classe;
use App\Model\Matiere;
use App\Model\Semestre;
use App\Model\Specialite;
use App\Model\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use PDF;
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
        return view('Etudiants.ajout',compact('annees'));
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
        $plainpass = Str::random(8);
        $params = ['role' => 'ROLE_ETUDIANT', 'password' => $plainpass];
        if ($image = $request->files->get('image')) {
            $destinationPath = 'images/etudiants/'; // upload path
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $params['image'] = $profileImage;
        }
        $user = User::create(array_merge($request->all(), $params));
        Mail::to($user->email)->send(new WelcomeMailWelearn($user,$plainpass));
        return redirect()->route('etudiant.index')->with('success','Etudiant Ajouté');
    }

    /**
     * Show the specified resource.
     *
     * @param  string  $cin
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show($cin)
    {
        $etudiant = User::where('cin',$cin)->first();
        $this->authorize('viewEtudiant', $etudiant);
        return view('Etudiants.show', compact('etudiant'));
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
        if ($password = $request->get('password'))
            $etudiant->password = $password;
        $etudiant->update(array_merge($request->except('password'),$params));
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

    /**
     * Generate specified resource PDF Carte Etudiant.
     * @param  string  $cin
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function generateCarte($cin) {
        $etudiant = User::where('cin',$cin)->first();
        $this->authorize('viewEtudiant', User::class);
        $pdf = PDF::loadView('docs.carte_etudiant', compact('etudiant'));
        return $pdf->download($etudiant->cin.'carte_etudiant'.'.pdf');
    }

    /**
     * Generate specified resource PDF AttestationPresence.
     * @param  string  $cin
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function generateAttestationPresence($cin) {
        $etudiant = User::where('cin',$cin)->first();
        $this->authorize('viewEtudiant', User::class);
        $pdf = PDF::loadView('docs.attestation_presence', compact('etudiant'));
        return $pdf->download($etudiant->cin.'attestation_presence'.'.pdf');
    }

    /**
     * Generate specified resource PDF AttestationPresence In Arabic.
     * @param  string  $cin
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function generateAttestationPresenceArabe($cin) {
        $etudiant = User::where('cin',$cin)->first();
        $this->authorize('viewEtudiant', User::class);
        $pdf = PDF::loadView('docs.attestation_presence_arabe', compact('etudiant'));
        return $pdf->download($etudiant->cin.'attestation_presence_arabe'.'.pdf');
    }

    /**
     * Generate specified resource PDF AttestationInscription .
     * @param  string  $cin
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function generateAttestationInscription($cin) {
        $etudiant = User::where('cin',$cin)->first();
        $this->authorize('viewEtudiant', User::class);
        $pdf = PDF::loadView('docs.attestation_inscription', compact('etudiant'));
        return $pdf->download($etudiant->cin.'attestation_inscription'.'.pdf');
    }

    /**
     * Generate specified resource PDF AttestationInscription In Arabic.
     * @param  string  $cin
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function generateAttestationInscriptionArabe($cin) {
        $etudiant = User::where('cin',$cin)->first();
        $this->authorize('viewEtudiant', User::class);
        //return view('docs.attestation_inscription_arabe', compact('etudiant'));
        $pdf = PDF::loadView('docs.attestation_inscription_arabe', compact('etudiant'));
        return $pdf->download($etudiant->cin.'attestation_inscription_arabe'.'.pdf');
    }

    /**
     * Generate specified resource PDF AttestationInscription.
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function generateBulletin($cin, $semestre_id) {
        $etudiant = User::where('cin',$cin)->first();
        $this->authorize('viewEtudiant', User::class);
        $classe = Classe::find($etudiant->classe_id);
        $annee = Annee::find($classe->niveau->specialite->id);
        $semestre = Semestre::find($semestre_id);
        $matieres = Matiere::where('semestre_id',$semestre_id)
            ->where('niveau_id',$classe->niveau_id)
            ->get();
        $abscences = Abscence::where('user_id',$etudiant->id)->get();
        $heures = 0;
        if ($abscences->count() > 0) {
            foreach ($abscences as $abscence) {
                $heures = $heures + $hourdiff = round((strtotime($abscence->seance->heure_fin) - strtotime($abscence->seance->heure_debut)) / 3600, 1);
            }
        }
        return view('docs.bulletin',compact('etudiant','classe','semestre','matieres','heures','annee'));
//        $pdf = PDF::loadView('docs.bulletin', compact('etudiant'));
//        return $pdf->download($etudiant->cin.'attestation_inscription'.'pdf');
    }
}
