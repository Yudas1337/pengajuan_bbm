<?php

namespace App\Repositories;

use App\Models\Station;

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
}
