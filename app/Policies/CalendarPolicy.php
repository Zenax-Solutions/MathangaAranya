<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Calendar;
use Illuminate\Auth\Access\HandlesAuthorization;

class CalendarPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the calendar can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the calendar can view the model.
     */
    public function view(User $user, Calendar $model): bool
    {
        return true;
    }

    /**
     * Determine whether the calendar can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the calendar can update the model.
     */
    public function update(User $user, Calendar $model): bool
    {
        return true;
    }

    /**
     * Determine whether the calendar can delete the model.
     */
    public function delete(User $user, Calendar $model): bool
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
     * Determine whether the calendar can restore the model.
     */
    public function restore(User $user, Calendar $model): bool
    {
        return false;
    }

    /**
     * Determine whether the calendar can permanently delete the model.
     */
    public function forceDelete(User $user, Calendar $model): bool
    {
        return false;
    }
}
