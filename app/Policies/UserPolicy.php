<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function create(User $user)
    {
        if ($user->isAdministrator() || $user->isModerator()) {
            return true;
        }
        return false;
    }

    public function view(User $user, User $user2)
    {
        if ($user->isAdministrator() || ($user->isModerator() AND $user->group_id === $user2->group_id)) {
            return true;
        }
        return false;
    }

    public function update(User $user, User $user2)
    {
        if ($user->isAdministrator() || ($user->isModerator() AND $user->group_id === $user2->group_id AND !$user2->isAdministrator())) {
            return true;
        }
        return false;
    }

    public function resetPassword(User $user, User $user2)
    {
        if ($user->isAdministrator() || ($user->isModerator() AND $user->group_id === $user2->group_id AND !$user2->isAdministrator())) {
            return true;
        }
        return false;
    }

    public function delete(User $user, User $user2)
    {
        if ($user->isAdministrator() || ($user->isModerator() AND $user->group_id === $user2->group_id AND !$user2->isAdministrator()) || $user === $user2) {
            return true;
        }
        return false;
    }
}
