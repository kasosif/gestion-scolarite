<?php

namespace App\Http\Controllers\Api;

use App\Model\Niveau;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NiveauController extends Controller
{
    public function niveaux() {
        if (!auth('api')->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = auth('api')->user();
        if ($user->role == 'ROLE_PROFESSEUR') {
            $niveaux = Niveau::with('specialite')
            ->get();
            return response()->json([
                'niveaux'=>$niveaux,
            ]);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
