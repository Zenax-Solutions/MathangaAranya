<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Event;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the event can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the event can view the model.
     */
    public function view(User $user, Event $model): bool
    {
        return true;
    }

    /**
     * Determine whether the event can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the event can update the model.
     */
    public function update(User $user, Event $model): bool
    {
        return true;
    }

    /**
     * Determine whether the event can delete the model.
     */
    public function delete(User $user, Event $model): bool
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
     * Determine whether the event can restore the model.
     */
    public function restore(User $user, Event $model): bool
    {
        return false;
    }

    /**
     * Determine whether the event can permanently delete the model.
     */
    public function forceDelete(User $user, Event $model): bool
    {
        return false;
    }
}
