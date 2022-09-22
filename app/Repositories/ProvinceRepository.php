<?php

namespace App\Repositories;

use App\Models\Province;
use App\Models\Regency;

class ProvinceRepository extends BaseRepository
{
    private Regency $regency;

    public function __construct(Province $province, Regency $regency)
    {
        $this->model = $province;
        $this->regency = $regency;
    }

    /**
     * Handle the Get all regencies data by specified id from models.
     *
     * @param string $id
     *
     * @return object
     */

    public function getAllRegencies(string $id): object
    {
        return $this->regency
            ->where(['province_id' => $id])
            ->get();
    }
}
