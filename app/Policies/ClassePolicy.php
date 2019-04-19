<?php

namespace App\Policies;

use App\Model\Privilege;
use App\Model\Classe;
use App\Model\User;
use Illuminate\Auth\Access\HandlesAuthorization;
class ClassePolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->role == 'ROLE_ADMIN'){
            return true;
        }
    }

    /**
     * Determine whether the user can view the classe.
     * @param \App\Model\User $user
     * @param  \App\Model\Classe  $classe
     * @return mixed
     */
    public function view(User $user, Classe $classe = null)
    {
        $pass = false;
        if($classe && $user->classe){
            $pass =  $user->classe->id == $classe->id;
        }
        $privilege = Privilege::where('titre','view_classes')->first();
        return ($user->privileges->contains($privilege->id)) || $pass;
    }

    /**
     * Determine whether the user can create classes.
     * @param \App\Model\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        $privilege = Privilege::where('titre','create_classes')->first();
        return $user->privileges->contains($privilege->id);
    }

    /**
     * Determine whether the user can update the classe.
     * @param \App\Model\User $user
     * @param  \App\Model\Classe  $classe
     * @return mixed
     */
    public function update(User $user, Classe $classe = null)
    {
        $privilege = Privilege::where('titre','update_classes')->first();
        return $user->privileges->contains($privilege->id);
    }

    /**
     * Determine whether the user can delete the classe.
     * @param \App\Model\User $user
     * @param  \App\Model\Classe  $classe
     * @return mixed
     */
    public function delete(User $user, Classe $classe = null)
    {
        $privilege = Privilege::where('titre','delete_classes')->first();
        return $user->privileges->contains($privilege->id);
    }
}
