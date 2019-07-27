<?php

namespace App\Http\Controllers;

use App\Model\Demande;
use App\Notifications\DocumentReady;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class DemandeController extends Controller
{
    public function index() {
        $demandes = Demande::all();
        return view('Demandes.index', compact('demandes'));
    }

    public function treat($demande_id) {
        $demande = Demande::find($demande_id);
        $user = $demande->user;
        $user->notify(new DocumentReady('icon-doc text-success','Demande d\'attestation de '.$demande->type.' Prete !'));
        $demande->delete();
        return redirect()->route('demande.index')->with('success','Demande traité');
    }

    public function destroy($demande_id) {
        $demande = Demande::find($demande_id);
        $demande->delete();
        return redirect()->route('demande.index')->with('success','Demande Supprimé');
    }
}
