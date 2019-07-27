<?php

namespace App\Http\Controllers\Api;

use App\Model\Classe;
use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class EtudiantController extends Controller
{
    public function etudiants() {

        if (!auth('api')->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user = auth('api')->user();

        if ($user->role == 'ROLE_PROFESSEUR') {
            $affectations = DB::table('affectations')
                ->select(DB::RAW('DISTINCT(classe_id)'))->where('user_id',$user->id)
                ->distinct()
                ->get();
            $classes_ids = [];
            foreach ($affectations as $a) {
                array_push($classes_ids, $a->classe_id);
            }
            $etudiants = User::with('classe')
                ->whereIn('classe_id', $classes_ids)->get();
            return response()->json([
                'etudiants' => $etudiants
            ]);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function etudiantsbyniveau($niveau_id) {
        if (!auth('api')->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user = auth('api')->user();

        if ($user->role == 'ROLE_PROFESSEUR') {
            $classes = Classe::select(DB::RAW('DISTINCT(id)'))->where('niveau_id',$niveau_id)
                ->get();
            $classes_ids = [];
            foreach ($classes as $classe) {
                array_push($classes_ids, $classe->id);
            }
            $etudiants = User::with('classe')
                ->whereIn('classe_id', $classes_ids)->get();
            return response()->json([
                'etudiants' => $etudiants
            ]);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
