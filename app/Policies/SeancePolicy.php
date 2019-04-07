<?php

namespace App\Policies;

use App\Model\Privilege;
use App\Model\Seance;
use App\Model\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class SeancePolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->role == 'ROLE_ADMIN'){
            return true;
        }
    }

    /**
     * Determine whether the user can view the seance.
     * @param \App\Model\User $user
     * @param  \App\Model\Seance  $seance
     * @return mixed
     */
    public function view(User $user, Seance $seance = null)
    {
        $privilege = Privilege::where('titre','view_seances')->first();
        return $user->privileges->contains($privilege->id);
    }

    /**
     * Determine whether the user can create seances.
     * @param \App\Model\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        $privilege = Privilege::where('titre','create_seances')->first();
        return $user->privileges->contains($privilege->id);
    }

    /**
     * Determine whether the user can update the seance.
     * @param \App\Model\User $user
     * @param  \App\Model\Seance  $seance
     * @return mixed
     */
    public function update(User $user,Seance $seance = null)
    {
        $privilege = Privilege::where('titre','update_seances')->first();
        return $user->privileges->contains($privilege->id);
    }

    /**
     * Determine whether the user can delete the seance.
     * @param \App\Model\User $user
     * @param  \App\Model\Seance  $seance
     * @return mixed
     */
    public function delete(User $user,Seance $seance = null)
    {

        $privilege = Privilege::where('titre','delete_seances')->first();
        return $user->privileges->contains($privilege->id);
    }
}
