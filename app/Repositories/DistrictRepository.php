<?php

namespace App\Repositories;

use App\Models\District;
use App\Models\Village;

class DistrictRepository extends BaseRepository
{
    private Village $village;

    public function __construct(District $district, Village $village)
    {
        $this->model = $district;
        $this->village = $village;
    }

    /**
     * Handle the Get all villages data by specified id from models.
     *
     * @param string $id
     *
     * @return object
     */

    public function getAllVillages(string $id): object
    {
        return $this->village
            ->where(['district_id' => $id])
            ->get();
    }
}
