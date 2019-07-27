<?php

namespace App\Http\Controllers\Api;

use App\Model\Affectation;
use App\Model\Annee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AffectationController extends Controller
{
    public function affectations(){
        if (!auth('api')->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = auth('api')->user();
        if ($user->role == 'ROLE_PROFESSEUR') {
            $affectations = Affectation::
            with('matiere','user','classe.niveau.specialite','matiere.devoirs')
                ->where('user_id', '=', $user->id)
                ->get();
            return response()->json([
                'affectations'=>$affectations,
            ]);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
