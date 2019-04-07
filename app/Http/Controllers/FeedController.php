<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeedRequest;
use App\Model\Classe;
use App\Model\Feed;
use App\Model\User;

class FeedController extends Controller
{
    /**
     * Display a listing of Feeds
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feeds = Feed::all();
        return view('Feeds.index',['feeds'=>$feeds]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Feeds.ajout');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  FeedRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FeedRequest $request)
    {
        $params = [];
        if (!$request->get('date')){
            $date = new \DateTime('now');
            $params['date'] = $date->format('Y-m-d');
        }
        Feed::create(array_merge($request->all(),$params));
        return redirect()->route('feed.index')->with('success','Actualité Ajouté');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $feed = Feed::findorFail($id);
        $classes = Classe::all();
        $etudiants = User::where('role', 'ROLE_ETUDIANT')->get();
        $professeurs = User::where('role', 'ROLE_PROFESSEUR')->get();
        return view('Feeds.modif',compact('feed','classes','etudiants','professeurs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  FeedRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FeedRequest $request, $id)
    {
        $feed = Feed::findorFail($id);
        $feed->user_id = null;
        $feed->classe_id = null;
        $params = [];
        if (!$request->get('date')){
            $date = new \DateTime('now');
            $params['date'] = $date->format('Y-m-d');
        }
        $feed->update(array_merge($request->all(),$params));
        return redirect()->route('feed.index')->with('success','Actualité Modifié');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $feed = Feed::findorFail($id);
        $feed->delete();
        return redirect()->route('feed.index')->with('success','Actualité Supprimé');
    }

}
