<?php

namespace App\Policies;

use App\Model\Privilege;
use App\Model\Salle;
use App\Model\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SallePolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->role == 'ROLE_ADMIN'){
            return true;
        }
    }

    /**
     * Determine whether the user can view the salle.
     * @param \App\Model\User $user
     * @param  \App\Model\Salle  $salle
     * @return mixed
     */
    public function view(User $user, Salle $salle = null)
    {
        $privilege = Privilege::where('titre','view_salles')->first();
        return $user->privileges->contains($privilege->id);
    }

    /**
     * Determine whether the user can create salles.
     * @param \App\Model\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        $privilege = Privilege::where('titre','create_salles')->first();
        return $user->privileges->contains($privilege->id);
    }

    /**
     * Determine whether the user can update the salle.
     * @param \App\Model\User $user
     * @param  \App\Model\Salle  $salle
     * @return mixed
     */
    public function update(User $user, Salle $salle = null)
    {
        $privilege = Privilege::where('titre','update_salles')->first();
        return $user->privileges->contains($privilege->id);
    }

    /**
     * Determine whether the user can delete the salle.
     * @param \App\Model\User $user
     * @param  \App\Model\Salle  $salle
     * @return mixed
     */
    public function delete(User $user, Salle $salle = null)
    {
        $privilege = Privilege::where('titre','delete_salles')->first();
        return $user->privileges->contains($privilege->id);
    }
}
