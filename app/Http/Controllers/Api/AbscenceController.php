<?php

namespace App\Http\Controllers\Api;

use App\Model\Abscence;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AbscenceController extends Controller
{
    public function myabscences(){
        if (!auth('api')->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user = auth('api')->user();

        if (($user->role == 'ROLE_ETUDIANT') || ($user->role == 'ROLE_PROFESSEUR')) {
            return response()->json([
                'abscences' => Abscence::with( 'classe.niveau.specialite','seance', 'matiere')
                ->where('user_id', '=', $user->id)
                ->get()
            ]);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
