<?php

namespace App\Policies;

use App\Models\Condominia;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CondominiaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if($user->isMaster()){
            return true;
        }

        $condominaId = $user->account->condominia_id;

        return $condominaId !== null;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Condominia $condominia): bool
    {
        return $user->isMaster() || $user->account->condominia_id  == $condominia->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role_id === 1;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Condominia $condominia): bool
    {
        return $user->role_id === 1;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Condominia $condominia): bool
    {
        return $user->role_id === 1;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Condominia $condominia): bool
    {
        return $user->role_id === 1;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Condominia $condominia): bool
    {
        return $user->role_id === 1;
    }
}
