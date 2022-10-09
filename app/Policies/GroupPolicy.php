<?php

namespace App\Policies;

use App\Models\Group;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  User  $user
     * @return bool
     */

    public function viewAny(User $user) : bool
    {
        return $user->can('view-group');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     *
     * @return bool
     */

    public function create(User $user) : bool
    {
        return $user->can('create-group');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     *
     * @return bool
     */

    public function update(User $user) : bool
    {
        return $user->can('update-group');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     *
     * @return bool
     */

    public function delete(User $user) : bool
    {
        return $user->can('delete-group');
    }
}
