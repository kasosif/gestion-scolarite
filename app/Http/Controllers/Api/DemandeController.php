<?php

namespace App\Http\Controllers\Api;

use App\Model\Demande;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class DemandeController extends Controller
{
    public function add(Request $request) {
        if (!auth('api')->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user = auth('api')->user();

        if ($user->role == 'ROLE_ETUDIANT') {
            $validator = Validator::make($request->all(), [
                'type' => ['required', 'regex:(Presence|Inscription)']
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Donnée(s) Incorrecte(s)'
                ]);
            }
            Demande::create(
                [
                    'type' => $request->get('type'),
                    'user_id' => $user->id,
                ]
            );
            return response()->json([
                'message' => 'Demande Envoyée'
            ]);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
    public function mydemandes() {
        if (!auth('api')->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user = auth('api')->user();

        if ($user->role == 'ROLE_ETUDIANT') {
            return response()->json([
                'demandes' => $user->demandes
            ]);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
