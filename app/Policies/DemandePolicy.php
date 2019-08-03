<?php

namespace App\Policies;

use App\Model\Demande;
use App\Model\Privilege;
use App\Model\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DemandePolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->role == 'ROLE_ADMIN'){
            return true;
        }
    }

    /**
     * Determine whether the user can view the Demande.
     * @param \App\Model\User $user
     * @param  \App\Model\Demande  $demande
     * @return mixed
     */
    public function view(User $user, Demande $demande = null)
    {
        $privilege = Privilege::where('titre','view_demandes')->first();
        return ($user->privileges->contains($privilege->id));
    }

    /**
     * Determine whether the user can update the demande.
     * @param \App\Model\User $user
     * @param  \App\Model\Demande  $demande
     * @return mixed
     */
    public function update(User $user, Demande $demande = null)
    {
        $privilege = Privilege::where('titre','update_demandes')->first();
        return $user->privileges->contains($privilege->id);
    }

    /**
     * Determine whether the user can delete the demande.
     * @param \App\Model\User $user
     * @param  \App\Model\Demande  $demande
     * @return mixed
     */
    public function delete(User $user, Demande $demande = null)
    {
        $privilege = Privilege::where('titre','delete_demandes')->first();
        return $user->privileges->contains($privilege->id);
    }
}
