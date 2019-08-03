<?php

namespace App\Http\Controllers\Api;

use App\Model\Classe;
use App\Model\Formation;
use App\Model\PartieFormation;
use App\Model\ProgressionEtudiant;
use App\Notifications\FormationAdded;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Webpatser\Uuid\Uuid;

class FormationController extends Controller
{
    public function formations(){
        if (!auth('api')->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = auth('api')->user();
        if ($user->role == 'ROLE_ETUDIANT') {
            $formations = Formation::with(
                ['niveau','user','partieformations',
                    'partieformations.progressionetudiants' => function ($query) use ($user) {
                        $query->where('user_id', $user->id);
                    }
                ])
                ->where('niveau_id', '=', $user->classe->niveau->id)
                ->get();
            return response()->json([
                'formations'=>$formations,
            ]);
        } else if ($user->role == 'ROLE_PROFESSEUR') {
            $formations = Formation::
            with('niveau.specialite', 'partieformations','partieformations.progressionetudiants')
                ->where('user_id', '=', $user->id)
                ->get();
            return response()->json([
                'formations'=>$formations,
            ]);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function singleformation($slug) {

        if (!auth('api')->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = auth('api')->user();
        if ($user->role == 'ROLE_ETUDIANT') {
            $formation = Formation::with(['partieformations' => function ($query) {
                    $query->orderBy('indice');
                }
                    ,
                    'partieformations.progressionetudiants' => function ($query) use ($user) {
                        $query->where('user_id', $user->id);
                    }]
            )
                ->where('slug', $slug)
                ->first();
            if ($formation->niveau->id == $user->classe->niveau->id) {
                return response()->json(
                    [
                        'formation' => $formation
                    ]
                );
            }
        }
        if ($user->role == 'ROLE_PROFESSEUR') {
            $formation = Formation::with(['niveau', 'niveau.specialite','partieformations' => function ($query) {
                $query->orderBy('indice');
            }, 'partieformations.progressionetudiants'])
                ->where('slug', $slug)
                ->first();
            if ($formation->user->id == $user->id) {
                return response()->json(
                    [
                        'formation' => $formation
                    ]
                );
            }
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function progress(Request $request) {
        if (!auth('api')->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user = auth('api')->user();

        if ($user->role == 'ROLE_ETUDIANT') {
            $validator = Validator::make($request->all(), [
                'partie' => ['required'],
                'time' => ['required'],
                'progress' => ['required'],
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Donnée(s) Incorrecte(s)'
                ]);
            }
            $progress = ProgressionEtudiant::updateOrCreate(
                ['user_id' => $user->id, 'partie_formation_id' => $request->get('partie')],
                ['progress' => $request->get('progress'), 'time' => $request->get('time')]
            );
            return response()->json([
                'progress' => $progress
            ]);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function view(Request $request, $uuid)
    {
        if ($request->query->get('token')){
            try {
                $user = JWTAuth::parseToken()->toUser();
                $partieformation = PartieFormation::where('uuid',$uuid)->first();
                if (($user->id == $partieformation->formation->user_id) || ($user->classe->niveau_id == $partieformation->formation->niveau_id)) {
                    $pathToFile = storage_path('app/formations/' . $partieformation->cover);
                    return response()->file($pathToFile);
                } else {
                    return response()->file(public_path('108944745.mp4'));
                }
            }catch (\Exception $e) {
                return response()->file(public_path('108944745.mp4'));
            }
        }
        return response()->file(public_path('108944745.mp4'));
    }

    public function add(Request $request) {
        if (!auth('api')->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user = auth('api')->user();
        if ($user->role == 'ROLE_PROFESSEUR') {
            $validator = Validator::make($request->all(), [
                'slug' => 'required|unique:formations',
                'image.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2200|min:5',
                'titre' => 'required|unique:formations|min:5',
                'description' => 'required|min:10',
                'niveau_id' => 'required|numeric',
                'parties.*' => 'required'
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'error' => $validator->errors()
                ]);
            }
            $params = [];
            $params['user_id'] = $user->id;
            if ($image = $request->files->get('image')) {
                $destinationPath = 'images/formations/'; // upload path
                $formationImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $formationImage);
                $params['image'] = $formationImage;
            }
            $formation = Formation::create(array_merge($request->except('parties'),$params));
            $duration = 0;
            for ($i = 1; $i < count($request->get('parties')) + 1; $i++) {
                $partie = new PartieFormation();
                $partie->titre = $request->get('parties')[$i]['titre'];
                $partie->indice = $i;
                $partie->cover = date('YmdHis') . "." .$request->files->get('parties')[$i]['video']->getClientOriginalName();
                $request->parties[$i]['video']->storeAs('formations', $partie->cover);
                $partie->uuid = (string)Uuid::generate();
                $getID3 = new \getID3;
                $file = $getID3->analyze(storage_path('app/formations/'.$partie->cover));
                $playtime_seconds = $file['playtime_seconds'];
                $duration = $duration + $playtime_seconds;
                $partie->formation_id = $formation->id;
                $partie->save();
            }
            $formation->duration = $duration;
            $formation->save();
            $classes = Classe::where('niveau_id','=',$request->get('niveau_id'))->get();
            foreach ($classes as $classe) {
                foreach ($classe->users as $user) {
                    $user->notify(
                        new FormationAdded(
                            'fa fa-play text-success',
                            $formation,
                            'Nouvelle Formation disponible'
                        )
                    );
                }
            }
            return response()->json([
                'success' => 'formation ajouté'
            ]);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
