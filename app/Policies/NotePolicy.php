<?php

namespace App\Policies;

use App\Model\Privilege;
use App\Model\User;
use App\Model\Note;
use Illuminate\Auth\Access\HandlesAuthorization;

class NotePolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->role == 'ROLE_ADMIN'){
            return true;
        }
    }

    /**
     * Determine whether the user can view the note.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\Note  $note
     * @return mixed
     */
    public function view(User $user, Note $note = null)
    {
        $privilege = Privilege::where('titre','view_notes')->first();
        return $user->privileges->contains($privilege->id);

    }

    /**
     * Determine whether the user can create notes.
     *
     * @param  \App\Model\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        $privilege = Privilege::where('titre','create_notes')->first();
        return $user->privileges->contains($privilege->id);
    }

    /**
     * Determine whether the user can update the note.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\Note  $note
     * @return mixed
     */
    public function update(User $user, Note $note)
    {
        $privilege = Privilege::where('titre','update_notes')->first();
        return $user->privileges->contains($privilege->id);
    }

    /**
     * Determine whether the user can delete the note.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\Note  $note
     * @return mixed
     */
    public function delete(User $user, Note $note)
    {
        $privilege = Privilege::where('titre','delete_notes')->first();
        return $user->privileges->contains($privilege->id);
    }
}
