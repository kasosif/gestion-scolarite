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
        $params['user_id'] = auth()->id();
        if (!$request->get('date')){
            $params['date'] = new \DateTime('now');
        }
        if ($image = $request->files->get('image')) {
            $destinationPath = 'images/feeds/'; // upload path
            $feedImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $feedImage);
            $params['image'] = $feedImage;
        }
        $feed = Feed::create(array_merge($request->except('users','classes'),$params));

        if ($request->get('users')){
            $feed->users()->attach($request->get('users'));
        }
        if ($request->get('classes')){
            $feed->classes()->attach($request->get('classes'));
        }
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
        $params = [];
        if ($image = $request->files->get('image')) {
            $destinationPath = 'images/feeds/'; // upload path
            if ($feed->image && file_exists(public_path().'/images/feeds/'.$feed->image)) {
                unlink(public_path().'/images/feeds/'.$feed->image);
            }
            $feedImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $feedImage);
            $params['image'] = $feedImage;
        }
        if (!$request->get('date')){
            $params['date'] = new \DateTime('now');
        }
        $feed->update(array_merge($request->except('users','classes'),$params));
        $feed->users()->sync([]);
        $feed->classes()->sync([]);
        if ($request->get('users')){
            $feed->users()->sync($request->get('users'),false);
        }
        if ($request->get('classes')){
            $feed->classes()->sync($request->get('classes'),false);
        }

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
        $feed->users()->sync([]);
        $feed->classes()->sync([]);
        $feed->delete();
        return redirect()->route('feed.index')->with('success','Actualité Supprimé');
    }

}
