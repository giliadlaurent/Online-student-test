<?php

namespace App\Policies;

use App\User;
use App\Group;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the group.
     *
     * @param  \App\User  $user
     * @param  \App\Group  $group
     * @return mixed
     */
    public function view(User $user, Group $group)
    {
        if ($user->isAdministrator() || ($user->isModerator() AND $user->group_id === $group->id)) {
            return true;
        }
        return false;
    }

    public function viewall(User $user)
    {
        if ($user->isAdministrator()) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can create groups.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->isAdministrator()) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the group.
     *
     * @param  \App\User  $user
     * @param  \App\Group  $group
     * @return mixed
     */
    public function update(User $user, Group $group)
    {
        if ($user->isAdministrator() || ($user->isModerator() AND $user->group_id === $group->id)) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the group.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function delete(User $user)
    {
        if ($user->isAdministrator()) {
            return true;
        }
        return false;
    }
}
