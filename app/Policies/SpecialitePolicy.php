<?php

namespace App\Policies;

use App\Model\Privilege;
use App\Model\User;
use App\Model\Specialite;
use Illuminate\Auth\Access\HandlesAuthorization;

class SpecialitePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the specialite.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\Specialite  $specialite
     * @return mixed
     */
    public function view(User $user, Specialite $specialite = null)
    {
        $privilege = Privilege::where('titre','view_specialites')->first();
        return $user->privileges->contains($privilege->id);
    }

    /**
     * Determine whether the user can create specialites.
     *
     * @param  \App\Model\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        $privilege = Privilege::where('titre','create_specialites')->first();
        return $user->privileges->contains($privilege->id);
    }

    /**
     * Determine whether the user can update the specialite.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\Specialite  $specialite
     * @return mixed
     */
    public function update(User $user, Specialite $specialite = null)
    {
        $privilege = Privilege::where('titre','update_specialites')->first();
        return $user->privileges->contains($privilege->id);
    }

    /**
     * Determine whether the user can delete the specialite.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\Specialite  $specialite
     * @return mixed
     */
    public function delete(User $user, Specialite $specialite = null)
    {
        $privilege = Privilege::where('titre','delete_specialites')->first();
        return $user->privileges->contains($privilege->id);
    }
}
