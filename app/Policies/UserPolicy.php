<?php

namespace App\Policies;

use App\Model\Privilege;
use App\Model\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        return $user->role == 'ROLE_ADMIN';
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Model\User  $user
     * @param User|null $model
     * @return mixed
     */
    public function viewEtudiant(User $user,User $model = null)
    {
        if ($model){
            return $user->id == $model->id;
        }
        $privilege = Privilege::where('titre','view_etudiants')->first();
        return $user->privileges->contains($privilege->id);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Model\User $user
     * @param User|null $model
     * @return mixed
     */
    public function viewProfesseur(User $user, User $model = null)
    {
        if ($model){
            return $user->id == $model->id;
        }
        $privilege = Privilege::where('titre','view_professeurs')->first();
        return $user->privileges->contains($privilege->id);
    }


    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Model\User  $user
     * @return mixed
     */
    public function createEtudiant(User $user)
    {
        $privilege = Privilege::where('titre','create_etudiants')->first();
        return $user->privileges->contains($privilege->id);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Model\User  $user
     * @return mixed
     */
    public function updateEtudiant(User $user)
    {
        $privilege = Privilege::where('titre','update_etudiants')->first();
        return $user->privileges->contains($privilege->id);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Model\User  $user
     * @return mixed
     */
    public function deleteEtudiant(User $user)
    {
        $privilege = Privilege::where('titre','delete_etudiants')->first();
        return $user->privileges->contains($privilege->id);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Model\User  $user
     * @return mixed
     */


    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Model\User  $user
     * @return mixed
     */
    public function createProfesseur(User $user)
    {
        $privilege = Privilege::where('titre','create_professeurs')->first();
        return $user->privileges->contains($privilege->id);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Model\User  $user
     * @return mixed
     */
    public function updateProfesseur(User $user)
    {
        $privilege = Privilege::where('titre','update_professeurs')->first();
        return $user->privileges->contains($privilege->id);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Model\User  $user
     * @return mixed
     */
    public function deleteProfesseur(User $user)
    {
        $privilege = Privilege::where('titre','delete_professeurs')->first();
        return $user->privileges->contains($privilege->id);
    }



}
