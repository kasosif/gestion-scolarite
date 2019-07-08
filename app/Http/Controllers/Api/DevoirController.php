<?php

namespace App\Http\Controllers\Api;

use App\Model\Devoir;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DevoirController extends Controller
{
    public function myexams(){

        if (!auth('api')->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user = auth('api')->user();

        if ($user->role == 'ROLE_ETUDIANT'){
            $devoirs = Devoir::with('matiere')
                ->where('classe_id',$user->classe_id)
                ->where('date', '>', new \DateTime('today'))
                ->orderBy('date')
                ->get();
            return response()->json([
                'devoirs' => $devoirs
            ]);

        } else if ($user->role == 'ROLE_PROFESSEUR') {
            $query = DB::table('devoirs')
                ->where('date', '>', new \DateTime('today'));
            $matieres = DB::table('affectations')->select('matiere_id')
                ->where('user_id',$user->id)
                ->distinct()
                ->get();
            foreach ($matieres as $matiere){
                $query->orWhere('matiere_id',$matiere->matiere_id);
            }
            $devoirs = $query->distinct()->get();
            return response()->json([
                'devoirs' => $devoirs
            ]);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
