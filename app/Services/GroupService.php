<?php

namespace App\Services;

use App\Http\Requests\GroupRequest;
use App\Repositories\GroupRepository;
use App\Traits\YajraTable;

class GroupService {
    use YajraTable;

    private GroupRepository $repository;

    public function __construct(GroupRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * handle fetch groups
     * 
     * @return object
     */
    
    public function handleFetchGroups() : object
    {
        return $this->repository->fetchGroups();
    }

    /**
     * handle get all group for yajra table
     * 
     * @return object|null
     */
    
    public function handleGetAll() : object|null
    {
        return $this->GroupMockup($this->repository->getAll());
    }

    /**
     * handle store group
     * 
     * @param GroupRequest $request
     * 
     * @return void
     */

    public function handleStoreGroup(GroupRequest $request) : void
    {
        $data = $request->validated();
        $data['group_name'] = str_replace(' ', '_', strtoupper($data['group_name']));
        $this->repository->store($data);
    }

    /**
     * handle update group
     * 
     * @param GroupRequest $request
     * @param string $id
     * 
     * @return void
     */

    public function handleUpdateGroup(GroupRequest $request, string $id) : void
    {
        $data = $request->validated();
        $data['group_name'] = str_replace(' ', '_', strtoupper($data['group_name']));
        $this->repository->update($id, $data);
    }

    /**
     * Delete specified group data from GroupRepository
     *
     * @param string $id
     *
     * @return mixed
     */

    public function handleDeleteGroup(string $id) : mixed
    {
        return $this->repository->destroy($id);
    }
}