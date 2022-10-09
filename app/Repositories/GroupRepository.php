<?php

namespace App\Repositories;

use App\Models\Group;

class GroupRepository extends BaseRepository {
    
    public function __construct(Group $group)
    {
        $this->model = $group;
    }

    /**
     * Handle the Get all data event from models.
     *
     * 
     * @return mixed
     */

    public function getAll() : mixed
    {
        return $this->model->query()
        ->with('user');
    }
}