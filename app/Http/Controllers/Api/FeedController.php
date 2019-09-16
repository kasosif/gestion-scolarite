<?php

namespace App\Http\Controllers\Api;

use App\Model\Feed;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class FeedController extends Controller
{
    public function feeds(){

        if (!auth('api')->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = auth('api')->user();
        if ($user->role == 'ROLE_ETUDIANT') {
            $myfeeds = Feed::with('user')
                ->select([DB::RAW('DISTINCT(feeds.id)'),'slug','titre','image', 'date', 'contenu', 'type', 'feeds.user_id'])
                ->leftJoin('feed_user','feed_user.feed_id','=','feeds.id')
                ->leftJoin('classe_feed','classe_feed.feed_id','=','feeds.id')
                ->where('feeds.type', '=', 'public')
                ->orWhere('feed_user.user_id',$user->id)
                ->orWhere('classe_feed.classe_id',$user->classe_id)
                ->orderBy('date','desc')
                ->get();
            return response()->json([
                'myfeeds'=>$myfeeds,
            ]);
        } else if ($user->role == 'ROLE_PROFESSEUR') {
            $classes = DB::table('affectations')->select('classe_id')->where('user_id',$user->id)
                ->distinct()
                ->get();

            $query = Feed::with('user')
                ->select([DB::RAW('DISTINCT(feeds.id)'),'slug','titre','image', 'date', 'contenu', 'type', 'feeds.user_id'])
                ->leftJoin('feed_user','feed_user.feed_id','=','feeds.id')
                ->leftJoin('classe_feed','classe_feed.feed_id','=','feeds.id')
                ->where('feeds.type', '=', 'public')
                ->orWhere('feed_user.user_id',$user->id)
                ->orWhere('feeds.user_id', $user->id);
            if ($classes->count()){
                foreach ($classes as $key => $classe){
                    $query = $query->orWhere('classe_feed.classe_id','=',$classe->classe_id);
                }
            }
            $myfeeds = $query
                ->orderBy('date','desc')
                ->get();
            return response()->json([
                'myfeeds'=>$myfeeds
            ]);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function singlefeed($slug) {
        if (!auth('api')->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user = auth('api')->user();
        if ($user->role == 'ROLE_ETUDIANT') {
            $feed = Feed::with('user')
                ->where('slug', $slug)
                ->first();
            if ($feed->type == 'public'){
                return response()->json([
                    'feed'=>$feed,
                ]);
            }
            if (($feed->user->id == $user->id) || ($feed->users->contains($user->id)) || ($feed->classes->contains($user->classe->id))) {
                return response()->json([
                    'feed'=>$feed,
                ]);
            }
        }
        if ($user->role == 'ROLE_PROFESSEUR') {
            $feed = Feed::with('user','classes','users')
                ->where('slug', $slug)
                ->first();
            if ($feed->type == 'public'){
                return response()->json([
                    'feed'=>$feed,
                ]);
            }
            if (($feed->user->id == $user->id)) {
                return response()->json([
                    'feed'=>$feed,
                ]);
            }
            if ($feed->users) {
                if ($feed->users->contains($user->id)) {
                    return response()->json([
                        'feed'=>$feed,
                    ]);
                }
            }
            if ($feed->classes) {
                $classes = DB::table('affectations')->select('classe_id')->where('user_id', $user->id)
                    ->distinct()
                    ->get();
                foreach ($classes as $classe) {
                    if ($feed->classes->contains('id',$classe->classe_id) ) {
                        return response()->json([
                            'feed'=>$feed,
                        ]);
                    }
                }
            }

        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function deletefeed($slug) {
        if (!auth('api')->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user = auth('api')->user();
        if ($user->role == 'ROLE_PROFESSEUR') {
            $feed = Feed::where('slug',$slug)->first();
            if ($feed && $feed->user_id == $user->id) {
                $feed->users()->sync([]);
                $feed->classes()->sync([]);
                $feed->delete();
                return response()->json([
                    'success' => true
                ]);
            }
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function editfeed(Request $request, $id) {
        if (!auth('api')->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user = auth('api')->user();
        if ($user->role == 'ROLE_PROFESSEUR') {
            $feed = Feed::findorFail($id);
            $validator = Validator::make($request->all(), [
                'titre' => [
                    'required',
                    'min:5',
                    Rule::unique('feeds')->ignore($feed->id)
                ],
                'slug' => [
                    'required',
                    Rule::unique('feeds')->ignore($feed->id)
                ],
                'image.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2200|min:5',
                'contenu' => 'required|min:10',
                'date' => 'nullable|date',
                'type' => ['required', 'regex:(public|classes|etudiants|professeurs)'],
                'users.*' => 'numeric',
                'classes.*' => 'numeric'
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'error' => $validator->errors()->first()
                ]);
            }
            $params = [];
            if ($feed && $feed->user_id == $user->id) {
                if ($image = $request->files->get('image')) {
                    $destinationPath = 'images/feeds/'; // upload path
                    if ($feed->image && file_exists(public_path().'/images/feeds/'.$feed->image)) {
                        unlink(public_path().'/images/feeds/'.$feed->image);
                    }
                    $feedImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                    $image->move($destinationPath, $feedImage);
                    $params['image'] = $feedImage;
                }
                if (!$request->get('date')){
                    $params['date'] = new \DateTime('now');
                }
                $feed->update(array_merge($request->except('users','classes'),$params));
                $feed->users()->sync([]);
                $feed->classes()->sync([]);
                if ($request->get('users')){
                    $feed->users()->sync($request->get('users'),false);
                }
                if ($request->get('classes')){
                    $feed->classes()->sync($request->get('classes'),false);
                }
                return response()->json([
                    'success' => true
                ]);
            }
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function add(Request $request) {
        if (!auth('api')->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user = auth('api')->user();
        if ($user->role == 'ROLE_PROFESSEUR') {
            $validator = Validator::make($request->all(), [
                'slug' => 'required|unique:feeds',
                'image.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2200|min:5',
                'titre' => 'required|unique:feeds|min:5',
                'contenu' => 'required|min:10',
                'date' => 'nullable|date',
                'type' => ['required', 'regex:(public|classes|etudiants|professeurs)'],
                'users.*' => 'numeric',
                'classes.*' => 'numeric'
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Donnée(s) Incorrecte(s)'
                ]);
            }
            $params = [];
            $params['user_id'] = $user->id;
            if (!$request->get('date')){
                $params['date'] = new \DateTime('now');
            }
            if ($image = $request->files->get('image')) {
                $destinationPath = 'images/feeds/'; // upload path
                $feedImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $feedImage);
                $params['image'] = $feedImage;
            }
            $feed = Feed::create(array_merge($request->except('users','classes'),$params));
            if ($request->get('users')) {
                $feed->users()->attach($request->get('users'));
            }
            if ($request->get('classes')){
                $feed->classes()->attach($request->get('classes'));
            }
            $feed = Feed::with('user')->find($feed->id);
            return response()->json([
                'feed' => $feed
            ]);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
