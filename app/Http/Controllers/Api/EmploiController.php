<?php

namespace App\Http\Controllers\Api;

use App\Model\Emploi;
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
        if ($user->role == 'ROLE_ETUDIANT'){
            $cases = Emploi::with('matiere','user','salle')
                ->where('classe_id',$user->classe_id)
                ->whereNotNull('user_id')
                ->whereDate('date_debut','<',$date)
                ->whereDate('date_fin','>',$date)
                ->get();
            return response()->json([
                'emplois' => $cases
            ]);
        } else if ($user->role == 'ROLE_PROFESSEUR') {
            $cases = Emploi::with('matiere','classe','salle')
                ->where('user_id',$user->id)
                ->whereDate('date_debut','<',$date)
                ->whereDate('date_fin','>',$date)
                ->get();
            return response()->json([
                'emplois'=>$cases
            ]);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
