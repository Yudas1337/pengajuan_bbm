<?php

namespace App\Repositories;

use App\Models\Station;
use Illuminate\Support\Facades\DB;

class StationRepository extends BaseRepository
{
    public function __construct(Station $station)
    {
        $this->model = $station;
    }

    /**
     * Handle the Get all data event from models.
     *
     * @return mixed
     */

    public function getAll(): mixed
    {
        return $this->model->query();
    }

    /**
     * Handle the Get all data event from models.
     *
     * @return mixed
     */

    public function getAllStations(): mixed
    {
        return $this->model->all();
    }

    /**
     * Handle the Get all data event from models.
     *
     * @param mixed $search
     * @param int $offset
     * @param int $results
     *
     * @return object
     */

    public function searchAjaxStations(mixed $search, int $offset, int $results): object
    {
        return $this->model->query()
            ->when($search, function ($query) use ($search) {
                return $query->whereLike('name', $search);
            })
            ->orderBy('name')
            ->skip($offset)
            ->take($results)
            ->get(['id', DB::raw('name as text')]);
    }
}
