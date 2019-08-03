<?php

namespace App\Policies;

use App\Model\Emploi;
use App\Model\Privilege;
use App\Model\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmploiPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->role == 'ROLE_ADMIN'){
            return true;
        }
    }

    /**
     * Determine whether the user can view the Emploi.
     * @param \App\Model\User $user
     * @param  \App\Model\Emploi  $emploi
     * @return mixed
     */
    public function view(User $user, Emploi $emploi = null)
    {
        $privilege = Privilege::where('titre','view_emplois')->first();
        return ($user->privileges->contains($privilege->id));
    }

    /**
     * Determine whether the user can create emplois.
     * @param \App\Model\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        $privilege = Privilege::where('titre','create_emplois')->first();
        return $user->privileges->contains($privilege->id);
    }

    /**
     * Determine whether the user can update the emploi.
     * @param \App\Model\User $user
     * @param  \App\Model\Emploi  $emploi
     * @return mixed
     */
    public function update(User $user, Emploi $emploi = null)
    {
        $privilege = Privilege::where('titre','update_emplois')->first();
        return $user->privileges->contains($privilege->id);
    }

    /**
     * Determine whether the user can delete the emploi.
     * @param \App\Model\User $user
     * @param  \App\Model\Emploi  $emploi
     * @return mixed
     */
    public function delete(User $user, Emploi $emploi = null)
    {
        $privilege = Privilege::where('titre','delete_emplois')->first();
        return $user->privileges->contains($privilege->id);
    }
}
