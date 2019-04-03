<?php

namespace App\Policies;

use App\Model\Privilege;
use App\Model\User;
use App\Model\Semestre;
use Illuminate\Auth\Access\HandlesAuthorization;

class SemestrePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the semestre.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\Semestre  $semestre
     * @return mixed
     */
    public function view(User $user, Semestre $semestre = null)
    {
        $privilege = Privilege::where('titre','view_semestres')->first();
        return $user->privileges->contains($privilege->id);
    }

    /**
     * Determine whether the user can create semestres.
     *
     * @param  \App\Model\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        $privilege = Privilege::where('titre','create_semestres')->first();
        return $user->privileges->contains($privilege->id);
    }

    /**
     * Determine whether the user can update the semestre.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\Semestre  $semestre
     * @return mixed
     */
    public function update(User $user, Semestre $semestre = null)
    {
        $privilege = Privilege::where('titre','update_semestres')->first();
        return $user->privileges->contains($privilege->id);
    }

    /**
     * Determine whether the user can delete the semestre.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\Semestre  $semestre
     * @return mixed
     */
    public function delete(User $user, Semestre $semestre = null)
    {
        $privilege = Privilege::where('titre','delete_semestres')->first();
        return $user->privileges->contains($privilege->id);
    }

}
