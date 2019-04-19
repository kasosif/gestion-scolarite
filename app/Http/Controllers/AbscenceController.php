<?php

namespace App\Http\Controllers;


use App\Http\Requests\AbscenceRequest;
use App\Model\Abscence;
use App\Model\Annee;
use App\Model\Seance;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbscenceController extends Controller
{
    /**
     * Display a listing of Years
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request)
    {
        $this->authorize('view', Abscence::class);
        $annees = Annee::all();
        $abscences = false;
        if ($user_id = $request->query('user_id')) {
            $query = Abscence::where('user_id',$user_id);
            if ($date = $request->query('date'))
                $query = $query->where('date','=',$date);
            $abscences = $query->get();
        }
        return view('Abscences.index',compact('abscences','annees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', Abscence::class);
        $annees = Annee::all();
        $seances = Seance::all();
        return view('Abscences.ajout',compact('annees','seances'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AbscenceRequest  $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(AbscenceRequest $request)
    {
        $this->authorize('create', Abscence::class);
        $params = [];
        if ($image = $request->files->get('justification')) {
            $destinationPath = 'images/abscences/'; // upload path
            dd(date('YmdHis'));
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $params['justification'] = $profileImage;
        }
        Abscence::create(array_merge($request->all(), $params));
        return redirect()->route('abscence.index')->with('success','Abscence Ajoutée');
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
        $abscence = Abscence::findorFail($id);
        $this->authorize('delete', $abscence);
        $abscence->delete();
        return redirect()->route('abscence.index')->with('success','Abscence Supprimé');
    }

}
