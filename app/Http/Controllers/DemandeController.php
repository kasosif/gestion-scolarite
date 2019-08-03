<?php

namespace App\Http\Controllers;

use App\Model\Demande;
use App\Notifications\DocumentReady;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class DemandeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index() {
        $this->authorize('view', Demande::class);
        $demandes = Demande::all();
        return view('Demandes.index', compact('demandes'));
    }

    /**
     * @param $demande_id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function treat($demande_id) {
        $this->authorize('update', Demande::class);
        $demande = Demande::find($demande_id);
        $user = $demande->user;
        $user->notify(new DocumentReady('icon-doc text-success','Demande d\'attestation de '.$demande->type.' Prete !'));
        $demande->delete();
        return redirect()->route('demande.index')->with('success','Demande traité');
    }

    /**
     * @param $demande_id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy($demande_id) {
        $this->authorize('delete', Demande::class);
        $demande = Demande::find($demande_id);
        $demande->delete();
        return redirect()->route('demande.index')->with('success','Demande Supprimé');
    }
}
