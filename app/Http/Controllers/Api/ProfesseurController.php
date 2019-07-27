<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ProfesseurController extends Controller
{
    public function professeurs() {

        if (!auth('api')->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user = auth('api')->user();

        if ($user->role == 'ROLE_PROFESSEUR') {
            $classes = DB::table('affectations')->select('classe_id')->where('user_id',$user->id)
                ->distinct()
                ->get();

            $query = DB::table('affectations')
                ->join('users', 'users.id', '=', 'affectations.user_id')
                ->select('users.*');
            foreach ($classes as $classe){
                $query = $query->orWhere('affectations.classe_id',$classe->classe_id);
            }
            $colleagues = $query->where('user_id','!=',$user->id)
                ->distinct()->get();
            return response()->json([
                'professeurs' => $colleagues
            ]);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
