<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Model\Classe;
use App\Model\Specialite;
use App\Model\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

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
        $specialites = DB::table('specialites')
            ->select('specialites.*')
            ->join('annees','specialites.annee_id','=','annees.id')
            ->where('annees.date_debut','<',Carbon::today())
            ->where('annees.date_fin','>',Carbon::today())
            ->get();
        return view('home',compact('profsnb','agentsnb','etudiantsnb','classesnb','specialitesnb','specialites','etudiants'));
    }

    /**
     * Show the application user profile
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profile()
    {
        return view('profile');
    }

    /**
     * profile update
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function updateprofile(ProfileRequest $request)
    {
        $user = Auth::user();
        $user->update($request->all());
        return redirect()->route('profile')->with('success','Profile mis a jour ');
    }

    /**
     * profile picture update
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function updateprofilepicture(ProfileRequest $request)
    {
        $user = Auth::user();
        $image = $request->files->get('image');
        $destinationPath = 'images/employes/'; // upload path
        if ($user->image && file_exists(public_path().'/images/employes/'.$user->image)) {
            unlink(public_path().'/images/employes/'.$user->image);
        }
        $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
        $image->move($destinationPath, $profileImage);
        $user->image = $profileImage;
        $user->save();
        return redirect()->route('profile')->with('success','Image mis a jour ');
    }

    public function changepassword(Request $request) {
        try {
            $this->validate($request, [
                'password' => ['required'],
                'new_password' => ['confirmed', 'required', 'regex:#^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$#','different:password'],
            ]);
        } catch (ValidationException $e) {
            return redirect()->route('profile')->with('error',$e->errors()['new_password'][0]);
        }
        $user = Auth::user();
        if (Hash::check($request->password, $user->password)) {
            $user->fill([
                'password' => $request->new_password
            ])->save();
            return redirect()->route('profile')->with('success', 'Mot de Passe changé');

        } else {
            return redirect()->route('profile')->with('error','Mot de Passe Actuel Incorrect');
        }
    }
}
