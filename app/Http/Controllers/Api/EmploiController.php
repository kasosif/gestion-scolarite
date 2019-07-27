<?php

namespace App\Http\Controllers\Api;

use App\Model\Emploi;
use App\Model\Jour;
use App\Model\Seance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class EmploiController extends Controller
{
    public function myschedule(){
        if (!auth('api')->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user = auth('api')->user();
        $date = new \DateTime('today');
        $jours = Jour::all();
        $seances = Seance::all();
        if ($user->role == 'ROLE_ETUDIANT'){
            $cases = Emploi::with('matiere','user','salle','seance','jour')
                ->where('classe_id',$user->classe_id)
                ->whereNotNull('user_id')
                ->whereDate('date_debut','<=',$date)
                ->whereDate('date_fin','>=',$date)
                ->get();
            return response()->json([
                'cases' => $cases,
                'jours' => $jours,
                'seances' => $seances
            ]);
        } else if ($user->role == 'ROLE_PROFESSEUR') {
            $cases = Emploi::with('matiere','classe.niveau.specialite','salle','seance','jour')
                ->where('user_id',$user->id)
                ->whereDate('date_debut','<=',$date)
                ->whereDate('date_fin','>=',$date)
                ->get();
            return response()->json([
                'cases'=>$cases,
                'jours' => $jours,
                'seances' => $seances
            ]);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
