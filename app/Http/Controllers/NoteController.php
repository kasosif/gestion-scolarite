<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteRequest;
use App\Model\Annee;
use App\Model\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of Notes
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $annees = Annee::all();
        $notes = false;
        if ($user_id = $request->query('user_id')) {
            $notes = Note::where('user_id',$user_id);
        }
        return view('Notes.index',['notes'=>$notes,'annees'=>$annees]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $annees = Annee::all();
        return view('Notes.ajout',compact('annees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  NoteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NoteRequest $request)
    {
        Note::create($request->all());
        return redirect()->route('note.index')->with('success','Note Ajouté');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $note = Note::findorFail($id);
        $note->delete();
        return redirect()->route('note.index')->with('success','Note Supprimé');
    }
}
