<?php

namespace App\Policies;

use App\Model\Privilege;
use App\Model\User;
use App\Model\Abscence;
use Illuminate\Auth\Access\HandlesAuthorization;

class AbscencePolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        return $user->role == 'ROLE_ADMIN';
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  User  $user
     * @param Abscence|null $model
     * @return mixed
     */
    public function view(User $user,Abscence $model = null)
    {
        $pass = false;
        if ($model){
            $pass = ($user->id == $model->user->id) || ($user->id == $model->matiere->user->id);
        }
        $privilege = Privilege::where('titre','view_abscences')->first();
        return ($user->privileges->contains($privilege->id)) || $pass;
    }


    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Model\User  $user
     * @return mixed
     */
    public function create(User $user)
    {

        $privilege = Privilege::where('titre','create_abscences')->first();
        return ($user->privileges->contains($privilege->id)) || ($user->role == 'ROLE_PROFESSEUR');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Model\User $user
     * @param Abscence $model
     * @return mixed
     */
    public function update(User $user, Abscence $model)
    {
        $pass = false;
        if($model){
            $pass =  $user->id == $model->matiere->user->id;
        }
        $privilege = Privilege::where('titre','update_abscences')->first();
        return ($user->privileges->contains($privilege->id)) || $pass;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Model\User $user
     * @param Abscence $model
     * @return mixed
     */
    public function delete(User $user, Abscence $model)
    {
        $pass = false;
        if($model){
            $pass =  $user->id == $model->matiere->user->id;
        }
        $privilege = Privilege::where('titre','delete_abscences')->first();
        return ($user->privileges->contains($privilege->id)) || $pass;
    }


}
