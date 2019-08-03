<?php

namespace App\Policies;

use App\Model\Formation;
use App\Model\Privilege;
use App\Model\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FormationPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->role == 'ROLE_ADMIN'){
            return true;
        }
    }

    /**
     * Determine whether the user can view the Formation.
     * @param \App\Model\User $user
     * @param  \App\Model\Formation  $formation
     * @return mixed
     */
    public function view(User $user, Formation $formation = null)
    {
        $privilege = Privilege::where('titre','view_formations')->first();
        return ($user->privileges->contains($privilege->id));
    }

    /**
     * Determine whether the user can create formations.
     * @param \App\Model\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        $privilege = Privilege::where('titre','create_formations')->first();
        return $user->privileges->contains($privilege->id);
    }

    /**
     * Determine whether the user can update the formation.
     * @param \App\Model\User $user
     * @param  \App\Model\Formation  $formation
     * @return mixed
     */
    public function update(User $user, Formation $formation = null)
    {
        $privilege = Privilege::where('titre','update_formations')->first();
        return $user->privileges->contains($privilege->id);
    }

    /**
     * Determine whether the user can delete the formation.
     * @param \App\Model\User $user
     * @param  \App\Model\Formation  $formation
     * @return mixed
     */
    public function delete(User $user, Formation $formation = null)
    {
        $privilege = Privilege::where('titre','delete_formations')->first();
        return $user->privileges->contains($privilege->id);
    }

}
