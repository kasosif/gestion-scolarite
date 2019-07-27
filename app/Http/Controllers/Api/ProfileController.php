<?php

namespace App\Http\Controllers\Api;

use App\Model\Affectation;
use App\Model\Classe;
use App\Model\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{

    public function me()
    {
        if (!auth('api')->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user = auth('api')->user();

        if ($user->role == 'ROLE_ETUDIANT'){
            return response()->json([
                'me'=>User::with(['classe','classe.niveau','classe.niveau.specialite'])->find($user->id),
                'classmates' => User::where('classe_id',$user->classe_id)->where('id','!=',$user->id)->get()
            ]);
        }

        if ($user->role == 'ROLE_PROFESSEUR'){

            $classes = DB::table('affectations')->select(DB::raw('DISTINCT(classe_id)'))->where('user_id',$user->id)
                ->distinct()
                ->get();
            $classe_ids = [];
            foreach ($classes as $classe) {
                array_push($classe_ids, $classe->classe_id);
            }
            $query = DB::table('affectations')
                ->join('users', 'users.id', '=', 'affectations.user_id')
                ->select('users.*')
                ->whereIn('affectations.classe_id', $classe_ids);
            $colleagues = $query->where('users.id','!=',$user->id)
                ->distinct()->get();
            return response()->json([
                'me'=>$user,
                'classmates' => $colleagues
            ]);
        }
        return response()->json(['error' => 'Unauthorized'], 401);

    }

    public function changepassword(Request $request){
        if (!auth('api')->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user = auth('api')->user();
        try {
            $this->validate($request, [
                'password' => ['required'],
                'new_password' => ['confirmed', 'required', 'regex:#^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$#','different:password'],
            ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => 'Password Missmatch']);
        }

        if (Hash::check($request->password, $user->password)) {
            $user->fill([
                'password' => $request->password
            ])->save();
            return response()->json(['success' => 'Password Changed']);

        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function getUser($cin) {
        if (!auth('api')->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $me = auth('api')->user();
        if (($me->role == 'ROLE_ETUDIANT') || ($me->role == 'ROLE_PROFESSEUR')){
            $user = User::with('classe.niveau.specialite','formations')
                ->where('cin',$cin)
                ->first();
            return response()->json([
                'user' => $user
            ]);
        }
        return response()->json(['error' => 'Unauthorized'], 401);

    }
}
