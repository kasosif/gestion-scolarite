<?php

namespace App\Policies;

use App\Model\Devoir;
use App\Model\Privilege;
use App\Model\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DevoirPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->role == 'ROLE_ADMIN'){
            return true;
        }
    }

    /**
     * Determine whether the user can view the devoir.
     * @param \App\Model\User $user
     * @param  \App\Model\Devoir  $devoir
     * @return mixed
     */
    public function view(User $user, Devoir $devoir = null)
    {
        $pass = false;
        if ($devoir){
            $pass = $user->id == $devoir->matiere->user->id;
        }
        $privilege = Privilege::where('titre','view_devoirs')->first();
        return ($user->privileges->contains($privilege->id)) || $pass;
    }

    /**
     * Determine whether the user can create devoirs.
     * @param \App\Model\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        $privilege = Privilege::where('titre','create_devoirs')->first();
        return ($user->privileges->contains($privilege->id)) || ($user->role == 'ROLE_PROFESSEUR');
    }

    /**
     * Determine whether the user can update the devoir.
     * @param \App\Model\User $user
     * @param  \App\Model\Devoir  $devoir
     * @return mixed
     */
    public function update(User $user, Devoir $devoir = null)
    {
        $pass = false;
        if ($devoir){
            $pass = $user->id == $devoir->matiere->user->id;
        }
        $privilege = Privilege::where('titre','update_devoirs')->first();
        return ($user->privileges->contains($privilege->id)) || $pass;
    }

    /**
     * Determine whether the user can delete the devoir.
     * @param \App\Model\User $user
     * @param  \App\Model\Devoir  $devoir
     * @return mixed
     */
    public function delete(User $user, Devoir $devoir = null)
    {
        $pass = false;
        if ($devoir){
            $pass = $user->id == $devoir->matiere->user->id;
        }
        $privilege = Privilege::where('titre','delete_devoirs')->first();
        return ($user->privileges->contains($privilege->id)) || $pass;
    }
}
