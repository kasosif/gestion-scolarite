<?php

namespace App\Http\Controllers;


use App\Http\Requests\ProfesseurRequest;
use App\Mail\WelcomeMailGs;
use App\Mail\WelcomeMailWelearn;
use App\Model\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ProfesseurController extends Controller
{
    /**
     * Display a listing of Teachers
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('viewProfesseur', User::class);
        $professeurs = User::where('role','ROLE_PROFESSEUR')->get();
        return view('Professeurs.index',['professeurs'=>$professeurs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('createProfesseur', User::class);
        return view('Professeurs.ajout');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ProfesseurRequest  $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(ProfesseurRequest $request)
    {
        $this->authorize('createProfesseur', User::class);
        $plainpass = Str::random(8);
        $params = ['role' => 'ROLE_PROFESSEUR','password' => $plainpass];
        if ($image = $request->files->get('image')) {
            $destinationPath = 'images/professeurs/'; // upload path
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $params['image'] = $profileImage;
        }
        $professeur = User::create(array_merge($request->all(), $params));
        Mail::to($professeur->email)->send(new WelcomeMailWelearn($professeur,$plainpass));
        return redirect()->route('professeur.index')->with('success','Professeur Ajouté');
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
        $professeur = User::where('cin',$cin)->first();
        $this->authorize('updateProfesseur', $professeur);
        return view('Professeurs.modif',compact('professeur'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ProfesseurRequest $request
     * @param  string  $cin
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @return \Illuminate\Http\Response
     */
    public function update(ProfesseurRequest $request, $cin)
    {
        $professeur = User::where('cin',$cin)->first();
        $this->authorize('updateProfesseur', $professeur);
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
        if ($password = $request->get('password'))
            $professeur->password = $password;
        $professeur->update(array_merge($request->except('password'),$params));
        return redirect()->route('professeur.index')->with('success','Professeur Modifié');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  string $cin
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy($cin)
    {
        $this->authorize('deleteProfesseur', User::class);
        $professeur = User::where('cin',$cin)->first();
        if ($professeur->image && file_exists(public_path().'/images/professeurs/'.$professeur->image)) {
            unlink(public_path().'/images/professeurs/'.$professeur->image);
        }
        $professeur->delete();
        return redirect()->route('professeur.index')->with('success','Professeur Supprimé');
    }
}
