<?php

namespace App\Policies;

use App\Model\Affectation;
use App\Model\Privilege;
use App\Model\Abscence;
use App\Model\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AbscencePolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->role == 'ROLE_ADMIN'){
            return true;
        }
    }

    /**
     * Determine whether the user can view the abscence.
     *
     * @param \App\Model\Abscence|null $model
     * @param \App\Model\User $user
     * @return mixed
     */
    public function viewEtudiant(User $user, Abscence $model = null)
    {
        $privilege = Privilege::where('titre','view_abscences_etudiant')->first();
        return ($user->privileges->contains($privilege->id));
    }


    /**
     * Determine whether the user can create abscences.
     * @param \App\Model\User $user
     * @return mixed
     */
    public function createEtudiant(User $user)
    {
        $privilege = Privilege::where('titre','create_abscences_etudiant')->first();
        return ($user->privileges->contains($privilege->id)) || ($user->role == 'ROLE_PROFESSEUR');
    }

    /**
     * Determine whether the user can delete the abscence.
     * @param \App\Model\User $user
     * @param \App\Model\Abscence $model
     * @return mixed
     */
    public function deleteEtudiant(User $user, Abscence $model)
    {
        $privilege = Privilege::where('titre','delete_abscences_etudiant')->first();
        return ($user->privileges->contains($privilege->id));
    }


    /**
     * Determine whether the user can view the abscence.
     *
     * @param \App\Model\Abscence|null $model
     * @param \App\Model\User $user
     * @return mixed
     */
    public function viewProfesseur(User $user, Abscence $model = null)
    {
        $privilege = Privilege::where('titre','view_abscences_professeur')->first();
        return ($user->privileges->contains($privilege->id));
    }


    /**
     * Determine whether the user can create abscences.
     * @param \App\Model\User $user
     * @return mixed
     */
    public function createProfesseur(User $user)
    {
        $privilege = Privilege::where('titre','create_abscences_professeur')->first();
        return ($user->privileges->contains($privilege->id)) || ($user->role == 'ROLE_PROFESSEUR');
    }

    /**
     * Determine whether the user can delete the abscence.
     * @param \App\Model\User $user
     * @param \App\Model\Abscence $model
     * @return mixed
     */
    public function deleteProfesseur(User $user, Abscence $model)
    {
        $privilege = Privilege::where('titre','delete_abscences_professeur')->first();
        return ($user->privileges->contains($privilege->id));
    }


}
