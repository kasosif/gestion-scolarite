<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteRequest;
use App\Model\Annee;
use App\Model\Devoir;
use App\Model\Note;
use App\Model\User;
use App\Notifications\MarkAdded;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of Notes
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request)
    {
        $this->authorize('view', Note::class);
        $annees = Annee::all();
        $notes = false;
        if ($user_id = $request->query('user_id')) {
            $notes = Note::where('user_id',$user_id)->get();
        }
        return view('Notes.index',['notes'=>$notes,'annees'=>$annees]);
    }

    /**
     * Show the form for creating a new resource.
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Note::class);
        $annees = Annee::all();
        return view('Notes.ajout',compact('annees'));
    }

    /**
     * Store a newly created resource in storage.
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @param  NoteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NoteRequest $request)
    {
        $this->authorize('create', Note::class);
        foreach ($request->get('notes') as $etudiantid => $note){
            if ($note) {
                Note::create([
                    'user_id' =>$etudiantid,
                    'devoir_id' =>$request->get('devoir_id'),
                    'mark' => $note
                ]);
                User::find($etudiantid)
                    ->notify(
                        new MarkAdded('icon-note text-success',Devoir::find($request->get('devoir_id')),'Nouvelle Note')
                );
            }
        }
        return redirect()->route('note.index')->with('success','Notes Ajouté');
    }


    /**
     * Remove the specified resource from storage.
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('create', Note::class);
        $note = Note::findorFail($id);
        $note->delete();
        return redirect()->route('note.index')->with('success','Note Supprimé');
    }
}
