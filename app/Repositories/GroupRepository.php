<?php

namespace App\Repositories;

use App\Helpers\UserHelper;
use App\Models\Group;
use Illuminate\Support\Facades\DB;

class GroupRepository extends BaseRepository
{

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

    public function getAll(): mixed
    {
        return $this->model->query()
            ->when(UserHelper::checkRolePenyuluh(), function ($q) {
                return $q->join('users', 'users.id', '=', 'groups.group_leader_id')
                    ->where('users.district_id', auth()->user()->district_id);
            })
            ->with('user');
    }

    /**
     * Handle the Get all data event from models.
     *
     *
     * @return mixed
     */

    public function fetchGroups(): mixed
    {
        return $this->model->with(['user.district', 'user.village', 'user.station'])->get();
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

    /**
     * count receiver per year by district
     *
     * @return object
     */

    public function countReceiverByDistrict(): object
    {
        return $this->model->query()
            ->select(DB::raw('groups.id, COUNT(receivers.id) AS receivers'))
            ->whereRelation('user', 'district_id', '=', auth()->user()->district_id)
            ->join('receivers', 'receivers.group_id', '=', 'groups.id')
            ->where(DB::raw('YEAR(receivers.created_at)'), '=', now()->format('Y'))
            ->groupBy('groups.id')
            ->get();
    }
}
