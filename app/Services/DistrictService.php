<?php

namespace App\Services;

use App\Repositories\DistrictRepository;

class DistrictService
{
    private DistrictRepository $repository;

    public function __construct(DistrictRepository $districtRepository)
    {
        $this->repository = $districtRepository;
    }

    /**
     * Handle get all districts from DistrictRepository.
     *
     * @return object
     */

    public function handleGetAllDistricts(): object
    {
        return $this->repository->getAll();
    }

    /**
     * Handle get all villages by specified id from DistrictRepository.
     *
     * @param string $id
     *
     * @return object
     */

    public function handleGetAllVillages(string $id): object
    {
        return $this->repository->getAllVillages($id);
    }

}
