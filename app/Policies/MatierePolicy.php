<?php

namespace App\Policies;

use App\Model\Matiere;
use App\Model\Privilege;
use App\Model\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class MatierePolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->role == 'ROLE_ADMIN'){
            return true;
        }
    }

    /**
     * Determine whether the user can view the matiere.
     * @param \App\Model\User $user
     * @param  \App\Model\Matiere  $matiere
     * @return mixed
     */
    public function view(User $user,Matiere $matiere = null)
    {
        $pass = false;
        if ($matiere){
            $pass = ($matiere->classe->contains($user->id)) || ($user->id == $matiere->user->id);
        }
        $privilege = Privilege::where('titre','view_matieres')->first();
        return ($user->privileges->contains($privilege->id)) || $pass;
    }

    /**
     * Determine whether the user can create matieres.
     * @param \App\Model\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        $privilege = Privilege::where('titre','create_matieres')->first();
        return ($user->privileges->contains($privilege->id));
    }

    /**
     * Determine whether the user can update the matiere.
     * @param \App\Model\User $user
     * @param  \App\Model\Matiere  $matiere
     * @return mixed
     */
    public function update(User $user,Matiere $matiere = null)
    {
        $pass = false;
        if ($matiere){
            $pass = $user->id == $matiere->user->id;
        }
        $privilege = Privilege::where('titre','update_matieres')->first();
        return ($user->privileges->contains($privilege->id)) || $pass;
    }

    /**
     * Determine whether the user can delete the matiere.
     * @param \App\Model\User $user
     * @param  \App\Model\Matiere  $matiere
     * @return mixed
     */
    public function delete(User $user,Matiere $matiere = null)
    {
        $privilege = Privilege::where('titre','delete_matieres')->first();
        return $user->privileges->contains($privilege->id);
    }
}
