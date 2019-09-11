<?php

namespace App\Http\Controllers\Api;

use App\Model\Classe;
use App\Model\Emploi;
use App\Model\Jour;
use App\Model\Seance;
use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use PDF;

class EmploiController extends Controller
{
    public function myschedule(){
        if (!auth('api')->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user = auth('api')->user();
        $date = new \DateTime('today');
        $jours = Jour::all();
        $seances = Seance::all();
        if ($user->role == 'ROLE_ETUDIANT'){
            $cases = Emploi::with('matiere','user','salle','seance','jour')
                ->where('classe_id',$user->classe_id)
                ->whereNotNull('user_id')
                ->whereDate('date_debut','<=',$date)
                ->whereDate('date_fin','>=',$date)
                ->get();
            return response()->json([
                'cases' => $cases,
                'jours' => $jours,
                'seances' => $seances
            ]);
        } else if ($user->role == 'ROLE_PROFESSEUR') {
            $cases = Emploi::with('matiere','classe.niveau.specialite','salle','seance','jour')
                ->where('user_id',$user->id)
                ->whereDate('date_debut','<=',$date)
                ->whereDate('date_fin','>=',$date)
                ->get();
            return response()->json([
                'cases'=>$cases,
                'jours' => $jours,
                'seances' => $seances
            ]);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
    public function oneschedule(Request $request){
        if (!auth('api')->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user = auth('api')->user();
        $date = new \DateTime('today');
        $jours = Jour::all();
        $seances = Seance::all();
        if ($user->role == 'ROLE_ETUDIANT'){
            if ($request->get('classe') == $user->classe_id) {
                $cases = Emploi::with('matiere','user','salle','seance','jour')
                    ->where('classe_id',$request->get('classe'))
                    ->whereNotNull('user_id')
                    ->whereDate('date_debut','=',$request->get('debut'))
                    ->whereDate('date_fin','=',$request->get('fin'))
                    ->get();
                return response()->json([
                    'cases' => $cases,
                    'jours' => $jours,
                    'seances' => $seances
                ]);
            }else {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        } else if ($user->role == 'ROLE_PROFESSEUR') {
            $cases = Emploi::with('matiere','classe.niveau.specialite','salle','seance','jour')
                ->where('user_id',$user->id)
                ->where('classe_id',$request->get('classe'))
                ->whereDate('date_debut','=',$request->get('debut'))
                ->whereDate('date_fin','=',$request->get('fin'))
                ->get();
            return response()->json([
                'cases'=>$cases,
                'jours' => $jours,
                'seances' => $seances
            ]);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
    public function schedules(){
        if (!auth('api')->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user = auth('api')->user();
        $date = new \DateTime('today');
        if ($user->role == 'ROLE_ETUDIANT'){
            $emplois = Emploi::with('classe.niveau.specialite')
            ->select([DB::RAW('DISTINCT(classe_id)'),'semaine','date_debut','date_fin'])
                ->where('classe_id',$user->classe_id)
                ->where('date_debut','>', $date)
                ->get();
            return response()->json([
                'emplois' => $emplois,
            ]);
        } else if ($user->role == 'ROLE_PROFESSEUR') {
            $emplois = Emploi::with('classe.niveau.specialite')
                ->select([DB::RAW('DISTINCT(classe_id)'),'semaine','date_debut','date_fin'])
                ->where('user_id',$user->id)
                ->whereDate('date_debut','>',$date)
                ->get();
            return response()->json([
                'emplois'=>$emplois
            ]);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function PDFschedule(Request $request){
        if (!auth('api')->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user = auth('api')->user();
        $jours = Jour::all();
        $seances = Seance::all();
        $dateD=new \DateTime($request->get('debut'));
        $dateF = new \DateTime($request->get('fin'));
        $titre_semaine = $request->get('semaine');
        if ($user->role == 'ROLE_ETUDIANT') {
            $classe = Classe::find($user->classe_id);
            $pagination = Emploi::where('classe_id',$classe->id)->where('date_debut',$dateD)->orderBy('seance_id')->get();
            $pdf = PDF::loadView('docs.emploisemaine', compact('pagination','jours','classe','dateD','dateF','seances','titre_semaine'));
            $pdf->setPaper('A4', 'landscape');
            return $pdf->download('emploi_classe_'.$classe->abbreviation.'_semaine_'.$dateD->format('d-m-Y').'_'.$dateF->format('d-m-Y').'pdf');
        } else if ($user->role == 'ROLE_PROFESSEUR') {
            $pagination = Emploi::where('user_id',$user->id)
                ->where('date_debut',$dateD)
                ->get();
            $pdf = PDF::loadView('docs.emploisemaine', compact('user','pagination','jours','dateD','dateF','seances','titre_semaine'));
            $pdf->setPaper('A4', 'landscape');
            return $pdf->download('emploi_professeur_'.$user->cin.'_semaine_'.$dateD->format('d-m-Y').'_'.$dateF->format('d-m-Y').'pdf');
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    static function caseSeanceJour($seance_id, $jour_id, $user_id, $dateD) {
        $cases = Emploi::where('user_id',$user_id)
            ->where('date_debut',$dateD)
            ->where('jour_id',$jour_id)
            ->where('seance_id', $seance_id)
            ->get();
        return $cases;
    }
}
