<?php

namespace App\Policies;

use App\Model\Privilege;
use App\Model\Feed;
use App\Model\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FeedPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->role == 'ROLE_ADMIN'){
            return true;
        }
    }

    /**
     * Determine whether the user can view the feed.
     * @param \App\Model\User $user
     * @param  \App\Model\Feed|null  $feed
     * @return mixed
     */
    public function view(User $user, Feed $feed = null)
    {
        $pass = false;
        if ($feed){
            if ($feed->user)
                $pass = $feed->user->id == $user->id;
            if (($feed->classe) && ($user->classe))
                $pass = $feed->classe->id == $user->classe->id;
        }
        $privilege = Privilege::where('titre','view_feeds')->first();
        return ($user->privileges->contains($privilege->id)) || $pass;
    }

    /**
     * Determine whether the user can create feeds.
     * @param \App\Model\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        $privilege = Privilege::where('titre','create_feeds')->first();
        return $user->privileges->contains($privilege->id);
    }

    /**
     * Determine whether the user can update the feed.
     * @param \App\Model\User $user
     * @param  \App\Model\Feed  $feed
     * @return mixed
     */
    public function update(User $user, Feed $feed = null)
    {
        $privilege = Privilege::where('titre','update_feeds')->first();
        return $user->privileges->contains($privilege->id);
    }

    /**
     * Determine whether the user can delete the feed.
     * @param \App\Model\User $user
     * @param  \App\Model\Feed  $feed
     * @return mixed
     */
    public function delete(User $user, Feed $feed = null)
    {

        $privilege = Privilege::where('titre','delete_feeds')->first();
        return $user->privileges->contains($privilege->id);
    }
}
