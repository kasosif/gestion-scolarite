<?php

namespace App\Http\Controllers\Api;

use App\Model\Feed;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeedController extends Controller
{
    public function feeds(){

        if (!auth('api')->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = auth('api')->user();
        if ($user->role == 'ROLE_ETUDIANT') {
            $myfeeds = Feed::with('user')
                ->select([DB::RAW('DISTINCT(feeds.id)'),'slug','image', 'date', 'contenu', 'type', 'feeds.user_id'])
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
                ->select([DB::RAW('DISTINCT(feeds.id)'),'slug','image', 'date', 'contenu', 'type', 'feeds.user_id'])
                ->leftJoin('feed_user','feed_user.feed_id','=','feeds.id')
                ->leftJoin('classe_feed','classe_feed.feed_id','=','feeds.id')
                ->where('feeds.type', '=', 'public')
                ->orWhere('feed_user.user_id',$user->id);
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
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
