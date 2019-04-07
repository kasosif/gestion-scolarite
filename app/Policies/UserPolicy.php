<?php

namespace App\Policies;

use App\Model\Privilege;
use App\Model\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->role == 'ROLE_ADMIN'){
            return true;
        }
    }

    /**
     * Determine whether the user can view the etudiant.
     * @param \App\Model\User $user
     * @param User|null $model
     * @return mixed
     */
    public function viewEtudiant(User $user, User $model = null)
    {
        $pass = false;
        if ($model){
            $pass =  $user->id == $model->id;
        }
        $privilege = Privilege::where('titre','view_etudiants')->first();
        return ($user->privileges->contains($privilege->id)) || $pass;
    }

    /**
     * Determine whether the user can view the professeur.
     * @param \App\Model\User $user
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
     * Determine whether the user can create etudiants.
     * @param \App\Model\User $user
     * @return mixed
     */
    public function createEtudiant(User $user)
    {
        $privilege = Privilege::where('titre','create_etudiants')->first();
        return $user->privileges->contains($privilege->id);
    }

    /**
     * Determine whether the user can update the etudiant.
     * @param \App\Model\User $user
     * @param  \App\Model\User  $model
     * @return mixed
     */
    public function updateEtudiant(User $user, User $model = null)
    {
        $pass = false;
        if ($model){
            $pass = $user->id == $model->id;
        }
        $privilege = Privilege::where('titre','update_etudiants')->first();
        return ($user->privileges->contains($privilege->id)) || $pass;
    }

    /**
     * Determine whether the user can delete the etudiant.
     * @param \App\Model\User $user
     * @return mixed
     */
    public function deleteEtudiant(User $user)
    {
        $privilege = Privilege::where('titre','delete_etudiants')->first();
        return $user->privileges->contains($privilege->id);
    }


    /**
     * Determine whether the user can create professeurs.
     * @param \App\Model\User $user
     * @param \App\Model\User $user
     * @return mixed
     */
    public function createProfesseur(User $user)
    {
        $privilege = Privilege::where('titre','create_professeurs')->first();
        return $user->privileges->contains($privilege->id);
    }

    /**
     * Determine whether the user can update the professeur.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\User  $model
     * @return mixed
     */
    public function updateProfesseur(User $user, User $model)
    {
        $pass = false;
        if ($model){
            $pass = $user->id == $model->id;
        }
        $privilege = Privilege::where('titre','update_professeurs')->first();
        return ($user->privileges->contains($privilege->id)) || $pass;
    }

    /**
     * Determine whether the user can delete the professeur.
     * @param  \App\Model\User  $user
     * @return mixed
     */
    public function deleteProfesseur(User $user)
    {
        $privilege = Privilege::where('titre','delete_professeurs')->first();
        return $user->privileges->contains($privilege->id);
    }



}
