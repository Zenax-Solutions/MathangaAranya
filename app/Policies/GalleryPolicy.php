<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Gallery;
use Illuminate\Auth\Access\HandlesAuthorization;

class GalleryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the gallery can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the gallery can view the model.
     */
    public function view(User $user, Gallery $model): bool
    {
        return true;
    }

    /**
     * Determine whether the gallery can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the gallery can update the model.
     */
    public function update(User $user, Gallery $model): bool
    {
        return true;
    }

    /**
     * Determine whether the gallery can delete the model.
     */
    public function delete(User $user, Gallery $model): bool
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
     * Determine whether the gallery can restore the model.
     */
    public function restore(User $user, Gallery $model): bool
    {
        return false;
    }

    /**
     * Determine whether the gallery can permanently delete the model.
     */
    public function forceDelete(User $user, Gallery $model): bool
    {
        return false;
    }
}
