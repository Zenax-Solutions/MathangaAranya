<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Speech;
use Illuminate\Auth\Access\HandlesAuthorization;

class SpeechPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the speech can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the speech can view the model.
     */
    public function view(User $user, Speech $model): bool
    {
        return true;
    }

    /**
     * Determine whether the speech can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the speech can update the model.
     */
    public function update(User $user, Speech $model): bool
    {
        return true;
    }

    /**
     * Determine whether the speech can delete the model.
     */
    public function delete(User $user, Speech $model): bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the speech can restore the model.
     */
    public function restore(User $user, Speech $model): bool
    {
        return false;
    }

    /**
     * Determine whether the speech can permanently delete the model.
     */
    public function forceDelete(User $user, Speech $model): bool
    {
        return false;
    }
}
