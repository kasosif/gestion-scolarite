<?php

namespace App\Http\Controllers\Api;

use App\Model\Note;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NoteController extends Controller
{
    public function notes(){
        if (!auth('api')->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user = auth('api')->user();

        if ($user->role == 'ROLE_ETUDIANT') {
            return response()->json([
                'notes' => Note::with( 'devoir.matiere', 'devoir', 'user')
                    ->where('user_id', '=', $user->id)
                    ->get()
            ]);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
