<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Community;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommunityPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the community can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the community can view the model.
     */
    public function view(User $user, Community $model): bool
    {
        return true;
    }

    /**
     * Determine whether the community can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the community can update the model.
     */
    public function update(User $user, Community $model): bool
    {
        return true;

    }

    /**
     * Determine whether the community can delete the model.
     */
    public function delete(User $user, Community $model): bool
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
     * Determine whether the community can restore the model.
     */
    public function restore(User $user, Community $model): bool
    {
        return false;
    }

    /**
     * Determine whether the community can permanently delete the model.
     */
    public function forceDelete(User $user, Community $model): bool
    {
        return false;
    }
}
