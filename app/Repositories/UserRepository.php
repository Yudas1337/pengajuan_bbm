<?php

namespace App\Repositories;

use App\Http\Resources\LoginResource;
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

    /**
     * Handle login api user from models.
     *
     * @param string $username
     *
     * @return mixed
     */

    public function handleLoginApi(string $username): mixed
    {
        return LoginResource::make($this->model->query()
            ->where('username', $username)
            ->with(['station', 'district'])
            ->firstOrFail());
    }

    /**
     * handle get group leader
     * 
     * @return object
     */

    public function handleGetGroupLeader() : object
    {
        return $this->model->query()
        ->role('Ketua Kelompok')
        ->get();
    }
}
