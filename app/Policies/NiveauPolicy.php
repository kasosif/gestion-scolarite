<?php

namespace App\Policies;

use App\Model\Niveau;
use App\Model\Privilege;
use App\Model\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NiveauPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->role == 'ROLE_ADMIN'){
            return true;
        }
    }

    /**
     * Determine whether the user can view the niveau.
     * @param \App\Model\User $user
     * @param  \App\Model\Niveau  $niveau
     * @return mixed
     */
    public function view(User $user, Niveau $niveau = null)
    {
        $privilege = Privilege::where('titre','view_niveaux')->first();
        return $user->privileges->contains($privilege->id);
    }

    /**
     * Determine whether the user can create niveaus.
     * @param \App\Model\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        $privilege = Privilege::where('titre','create_niveaux')->first();
        return $user->privileges->contains($privilege->id);
    }

    /**
     * Determine whether the user can update the niveau.
     * @param \App\Model\User $user
     * @param  \App\Model\Niveau  $niveau
     * @return mixed
     */
    public function update(User $user, Niveau $niveau = null)
    {
        $privilege = Privilege::where('titre','update_niveaux')->first();
        return $user->privileges->contains($privilege->id);
    }

    /**
     * Determine whether the user can delete the niveau.
     * @param \App\Model\User $user
     * @param  \App\Model\Niveau  $niveau
     * @return mixed
     */
    public function delete(User $user, Niveau $niveau = null)
    {
        $privilege = Privilege::where('titre','delete_niveaux')->first();
        return $user->privileges->contains($privilege->id);
    }
}
