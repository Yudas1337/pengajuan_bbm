<?php

namespace App\Services;

use App\Repositories\ProvinceRepository;

class ProvinceService
{
    private ProvinceRepository $repository;

    public function __construct(ProvinceRepository $provinceRepository)
    {
        $this->repository = $provinceRepository;
    }

    /**
     * Handle get all provinces from ProvinceRepository.
     *
     * @return object
     */

    public function handleGetAllProvinces(): object
    {
        return $this->repository->getAll();
    }

    /**
     * Handle get all regencies by specified id from ProvinceRepository.
     *
     * @param string $id
     *
     * @return object
     */

    public function handleGetAllRegencies(string $id): object
    {
        return $this->repository->getAllRegencies($id);
    }
}
