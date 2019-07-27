<?php

namespace App\Http\Controllers\Api;

use App\Model\Devoir;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
            $query = Devoir::with('matiere','classe.niveau.specialite')
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

    public function add(Request $request) {
        if (!auth('api')->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user = auth('api')->user();
        if ($user->role == 'ROLE_PROFESSEUR') {
            $annee = DB::table('annees')
                ->select('annees.*')
                ->where('annees.date_debut','<',Carbon::today())
                ->where('annees.date_fin','>',Carbon::today())
                ->first();
            $date = $annee->date_fin;
            $validator = Validator::make($request->all(), [
                'coeficient' => 'required|numeric',
                'date' => 'required|date|after: today|before: '.$date,
                'type' => [
                    'required',
                    'regex:(controle|examen)'
                ],
                'matiere_id' => 'required|numeric'
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Donnée(s) Incorrecte(s)'
                ]);
            }
            $devoir = Devoir::create($request->all());
            $devoir = Devoir::with('matiere','classe.niveau.specialite')->find($devoir->id);
            return response()->json([
                'devoir' => $devoir
            ]);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
    public function delete($id) {
        if (!auth('api')->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user = auth('api')->user();
        if ($user->role == 'ROLE_PROFESSEUR') {
            $devoir = Devoir::find($id);
            $devoir->delete();
            return response()->json([
                'message' => 'Succees'
            ]);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function update($id, Request $request) {
        if (!auth('api')->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user = auth('api')->user();
        if ($user->role == 'ROLE_PROFESSEUR') {
            $devoir = Devoir::find($id);
            $devoir->date = $request->get('date');
            $devoir->save();
            return response()->json([
                'message' => 'Succees'
            ]);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function exams() {
        if (!auth('api')->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user = auth('api')->user();

        if ($user->role == 'ROLE_PROFESSEUR') {
            $query = Devoir::with('matiere','classe.niveau.specialite', 'notes.user')
                ->where('date', '<', new \DateTime('today'));
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
