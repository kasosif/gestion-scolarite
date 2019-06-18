<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AbscenceController extends Controller
{
    public function myabscences(){
        if (!auth('api')->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user = auth('api')->user();

        if ($user->role == 'ROLE_ETUDIANT') {
            return response()->json([
                'abscences' => $user->abscences
            ]);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
