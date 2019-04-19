<?php

namespace App\Http\Controllers;


use App\Http\Requests\EmployeRequest;
use App\Model\Privilege;
use App\Model\User;
use Illuminate\Http\Request;

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
        $privileges = Privilege::all();
        return view('Employes.ajout',compact('privileges'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  EmployeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeRequest $request)
    {
        $params = ['role' => 'ROLE_EMPLOYE'];
        if ($image = $request->files->get('image')) {
            $destinationPath = 'images/employes/'; // upload path
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $params['image'] = $profileImage;
        }
        $employe = User::create(array_merge($request->except(['privileges']), $params));
        $employe->privileges()->attach($request->get('privileges'));
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
        $privileges = Privilege::all();
        $employe = User::where('cin',$cin)->first();
        return view('Employes.modif', compact('employe','privileges'));
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
