<?php

namespace App\Policies;

use App\Model\Privilege;
use App\Model\User;
use App\Model\Annee;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnneePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the annee.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\Annee  $annee
     * @return mixed
     */
    public function view(User $user, Annee $annee = null)
    {
        $privilege = Privilege::where('titre','view_annees')->first();
        return $user->privileges->contains($privilege->id);
    }

    /**
     * Determine whether the user can create annees.
     *
     * @param  \App\Model\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        $privilege = Privilege::where('titre','create_annees')->first();
        return $user->privileges->contains($privilege->id);
    }

    /**
     * Determine whether the user can update the annee.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\Annee  $annee
     * @return mixed
     */
    public function update(User $user, Annee $annee)
    {
        $privilege = Privilege::where('titre','update_annees')->first();
        return $user->privileges->contains($privilege->id);
    }

    /**
     * Determine whether the user can delete the annee.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\Annee  $annee
     * @return mixed
     */
    public function delete(User $user, Annee $annee)
    {
        $privilege = Privilege::where('titre','delete_annees')->first();
        return $user->privileges->contains($privilege->id);
    }

}
