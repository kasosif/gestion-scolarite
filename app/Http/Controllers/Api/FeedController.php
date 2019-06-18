<?php

namespace App\Http\Controllers\Api;

use App\Model\Feed;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class FeedController extends Controller
{
    public function feeds(){

        if (!auth('api')->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = auth('api')->user();
        if ($user->role == 'ROLE_ETUDIANT'){
            $myfeeds = Feed::with('users')
                ->join('feed_user','feed_user.feed_id','=','feeds.id')
                ->where('type','=','etudiants')
                ->where('feed_user.user_id',$user->id)
                ->get();
            $classfeeds = Feed::with('classes')
                ->join('classe_feed','classe_feed.feed_id','=','feeds.id')
                ->where('type','=','classes')
                ->where('classe_feed.classe_id',$user->classe_id)
                ->get();
            return response()->json([
                'myfeeds'=>$myfeeds,
                'classfeeds' => $classfeeds
            ]);
        } else if ($user->role == 'ROLE_PROFESSEUR') {
            $classes = DB::table('affectations')->select('classe_id')->where('user_id',$user->id)
                ->distinct()
                ->get();

            $myfeeds = Feed::with('users','classes')
                ->join('feed_user','feed_user.feed_id','=','feeds.id')
                ->where('type','=','professeurs')
                ->where('feed_user.user_id',$user->id)
                ->get();
            $query = Feed::with('classes','users')
                ->join('classe_feed','classe_feed.feed_id','=','feeds.id')
                ->where('type','=','classes');
            if ($classes->count()){
                foreach ($classes as $key => $classe){
                    if ($key == 0){
                        $query = $query->where('classe_feed.classe_id','=',$classe->classe_id);
                    }
                    $query = $query->orWhere('classe_feed.classe_id','=',$classe->classe_id);
                }
            }
            $classfeeds = $query
                ->distinct()
                ->get();
            return response()->json([
                'myfeeds'=>$myfeeds,
                'classfeeds' => $classfeeds
            ]);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
