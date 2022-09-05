<?php

namespace App\Services;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ProfileRequest;
use App\Repositories\UserRepository;

class UserService
{
    private $repository;

    function __construct(UserRepository $userRepository)
    {
        $this->repository = $userRepository;
    }

    /**
     * Update current user profile
     *
     * @param  ProfileRequest $request
     * @param mixed $id
     * 
     * @return void
     */

    public function updateProfile(ProfileRequest $request, mixed $id): void
    {
        $this->repository->update($id, $request->validated());
    }

    /**
     * Update current user password
     *
     * @param  ChangePasswordRequest $request
     * 
     * @return void
     */

    public function changePassword(ChangePasswordRequest $request): void
    {
        $validated = $request->validated();

        $this->repository->update(auth()->id(), [
            'password'  => bcrypt($validated['password'])
        ]);
    }
}
