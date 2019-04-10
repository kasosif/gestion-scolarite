<?php

namespace App\Http\Controllers;

use App\Model\Classe;
use App\Model\Specialite;
use App\Model\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $etudiantsnb = User::where('role','ROLE_ETUDIANT')->count();
        $etudiants = User::where('role','ROLE_ETUDIANT');
        $profsnb = User::where('role','ROLE_PROFESSEUR')->count();
        $agentsnb = User::where('role','ROLE_EMPLOYE')->count();
        $classesnb = Classe::all()->count();
        $specialitesnb = Specialite::all()->count();
        $specialites = Specialite::all();
        return view('home',compact('profsnb','agentsnb','etudiantsnb','classesnb','specialitesnb','specialites','etudiants'));
    }
}
