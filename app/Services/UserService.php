<?php

namespace App\Services;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\Users\StoreRequest;
use App\Http\Requests\Users\UpdateRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Traits\YajraTable;

class UserService
{
    use YajraTable;

    private UserRepository $repository;

    public function __construct(UserRepository $userRepository)
    {
        $this->repository = $userRepository;
    }

    /**
     * Update current user profile
     *
     * @param ProfileRequest $request
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
     * @param ChangePasswordRequest $request
     *
     * @return void
     */

    public function changePassword(ChangePasswordRequest $request): void
    {
        $validated = $request->validated();

        $this->repository->update(auth()->id(), [
            'password' => bcrypt($validated['password'])
        ]);
    }

    /**
     * Handle get all available users from UserRepository
     *
     * @return object|null
     */

    public function handleGetUser(): object|null
    {
        return $this->UserMockup($this->repository->getAll());
    }

    /**
     * Handle get all inactive users from UserRepository
     *
     * @return object|null
     */

    public function handleGetInactiveUsers(): object|null
    {
        return $this->UserMockup($this->repository->getInactives());
    }

    /**
     * Handle store user data from UserRepository
     *
     * @param StoreRequest $request
     *
     * @return void
     */

    public function handleStoreUser(StoreRequest $request): void
    {
        $validated = $request->validated();

        $user = $this->repository->store([
            'station_id' => $validated['station_id'] ?? null,
            'name' => $validated['name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'district_id' => $validated['district_id'] ?? null,
            'village_id'    => $validated['village_id'] ?? null
        ]);

        $user->assignRole($validated['roles']);
    }

    /**
     * Handle update specified user data from UserRepository
     *
     * @param UpdateRequest $request
     * @param User $user
     *
     * @return void
     */

    public function handleUpdateUser(UpdateRequest $request, User $user): void
    {
        $validated = $request->validated();

        $this->repository->update($user->id, [
            'station_id' => $validated['station_id'] ?? null,
            'name' => $validated['name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'district_id' => $validated['district_id'] ?? null,
            'village_id'    => $validated['village_id'] ?? null
        ]);

        $user->syncRoles([$validated['roles']]);
    }

    /**
     * Handle soft delete specified user data from UserRepository
     *
     * @param string $id
     *
     * @return void
     */

    public function handleDeleteUser(string $id): void
    {
        $this->repository->destroy($id);
    }

    /**
     * Handle activate specified user data from UserRepository
     *
     * @param string $id
     *
     * @return void
     */

    public function handleActivateUser(string $id): void
    {
        $this->repository->restore($id);
    }

    /**
     * handle get group leader
     * 
     * @return object
     */

    public function handleGetGroupLeader() : object
    {
        return $this->repository->handleGetGroupLeader();
    }
}
