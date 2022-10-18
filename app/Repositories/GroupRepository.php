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

    /**
     * Handle the Get all data event from models.
     *
     * 
     * @return mixed
     */

    public function fetchGroups() : mixed
    {
        return $this->model->all();
    }

    /**
     * get group by kecamatan
     * 
     * @param string $districtId
     * 
     * @return object|null
     */
    public function getGroupByKecamatan(string $districtId): object|null
    {
        return $this->model->query()
            ->with(['user.district', 'user.village', 'user.station'])
            ->whereRelation('user', 'district_id', '=', $districtId)
            ->get();
    }
}