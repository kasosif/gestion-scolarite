<?php

namespace App\Http\Controllers\Api;

use App\Model\Classe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ClasseController extends Controller
{
    public function classes() {

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
            $classes = Classe::with('niveau', 'niveau.specialite')
                ->whereIn('id', $classes_ids)->get();
            return response()->json([
                'classes' => $classes
            ]);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
