<?php

namespace App\Http\Controllers;


use App\Http\Requests\EmployeRequest;
use App\Mail\WelcomeMailGs;
use App\Model\Privilege;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class EmployeController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of employes
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employes = User::where('role','ROLE_EMPLOYE')->get();
        return view('Employes.index',['employes'=>$employes]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ressources = Privilege::distinct('ressource')->get('ressource');
        return view('Employes.ajout',compact('ressources'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  EmployeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeRequest $request)
    {
        $plainpass = Str::random(8);
        $params = ['role' => 'ROLE_EMPLOYE', 'password' => $plainpass];
        if ($image = $request->files->get('image')) {
            $destinationPath = 'images/employes/'; // upload path
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $params['image'] = $profileImage;
        }
        $employe = User::create(array_merge($request->except(['privileges']), $params));
        $employe->privileges()->attach($request->get('privileges'));
        Mail::to($employe->email)->send(new WelcomeMailGs($employe,$plainpass));
        return redirect()->route('employe.index')->with('success','Employe Ajouté');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $cin
     * @return \Illuminate\Http\Response
     */
    public function edit($cin)
    {
        $ressources = Privilege::distinct('ressource')->get('ressource');
        $employe = User::where('cin',$cin)->first();
        return view('Employes.modif', compact('employe','ressources'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EmployeRequest $request
     * @param  string  $cin
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeRequest $request, $cin)
    {
        $employe = User::where('cin',$cin)->first();
        $params = [];
        if ($image = $request->files->get('image')) {
            $destinationPath = 'images/employes/'; // upload path
            if ($employe->image && file_exists(public_path().'/images/employes/'.$employe->image)) {
                unlink(public_path().'/images/employes/'.$employe->image);
            }
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $params['image'] = $profileImage;
        }
        if ($password = $request->get('password'))
            $employe->password = $password;
        $employe->update(array_merge($request->except(['privileges','password']),$params));
        $employe->privileges()->sync([]);
        $employe->privileges()->sync($request->get('privileges'),false);
        return redirect()->route('employe.index')->with('success','Employe Modifié');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $cin
     * @return \Illuminate\Http\Response
     */
    public function destroy($cin)
    {
        $employe = User::where('cin',$cin)->first();
        if ($employe->image && file_exists(public_path().'/images/employes/'.$employe->image)) {
            unlink(public_path().'/images/employes/'.$employe->image);
        }
        $employe->privileges()->sync([]);
        $employe->delete();
        return redirect()->route('employe.index')->with('success','Employe Supprimé');
    }
}
