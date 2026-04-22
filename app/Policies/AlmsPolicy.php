<?php

namespace App\Policies;

use App\Models\Alms;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AlmsPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Alms $alms): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Alms $alms): bool
    {
        return true;
    }

    public function delete(User $user, Alms $alms): bool
    {
        return true;
    }
}
