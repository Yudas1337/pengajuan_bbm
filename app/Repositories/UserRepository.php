<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * Handle the Get all data event from models.
     *
     *
     * @return mixed
     */

    public function getAll(): mixed
    {
        return $this->model->query()
            ->with('roles');
    }

    /**
     * Handle Get all inactive users from User Model
     *
     * @return object|null
     */

    public function getInactives(): mixed
    {
        return $this->trashedUser()
            ->with('roles');
    }

    /**
     * Handle get trashed user instantly from models.
     *
     * @return mixed
     */

    public function trashedUser(): mixed
    {
        return $this->model->query()
            ->onlyTrashed();
    }

    /**
     * Handle restore trashed user instantly from models.
     *
     * @param string $id
     *
     * @return mixed
     */

    public function restore(string $id): mixed
    {
        return $this->trashedUser()->where('id', $id)->restore();
    }
}
