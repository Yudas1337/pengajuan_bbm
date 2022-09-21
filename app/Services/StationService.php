<?php

namespace App\Services;

use App\Http\Requests\StationRequest;
use App\Repositories\StationRepository;
use App\Traits\YajraTable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StationService
{
    use YajraTable;

    private StationRepository $repository;

    public function __construct(StationRepository $stationRepository)
    {
        $this->repository = $stationRepository;
    }

    /**
     * Get all stations for select2 with ajax from StationRepository
     *
     * @param Request $request
     *
     * @return JsonResponse
     */

    public function handleSelectAjaxStations(Request $request): JsonResponse
    {
        $page = $request->page;
        $search = $request->term;

        $resultCount = 25;

        $offset = ($page - 1) * $resultCount;

        $results = $this->repository->searchAjaxStations($search, $offset, $resultCount);

        $morePages = ($offset + $resultCount) < $this->repository->countAll();

        $results = array(
            "results" => $results,
            "pagination" => array(
                "more" => $morePages
            )
        );

        return response()->json($results);
    }

    /**
     * Get all stations from StationRepository
     *
     * @return object|null
     */

    public function handleGetAllStations(): object|null
    {
        return $this->repository->getAllStations();
    }

    /**
     * Get all stations from StationRepository with yajra table
     *
     * @return object|null
     */

    public function handleGetStations(): object|null
    {
        return $this->StationMockup($this->repository->getAll());
    }

    /**
     * Store station data to StationRepository
     *
     * @param StationRequest $request
     *
     * @return void
     */

    public function handleStoreStation(StationRequest $request): void
    {
        $this->repository->store($request->validated());
    }

    /**
     * Update specified station data from StationRepository
     *
     * @param StationRequest $request
     * @param string $id
     *
     * @return void
     */

    public function handleUpdateStation(StationRequest $request, string $id): void
    {
        $this->repository->update($id, $request->validated());
    }

    /**
     * Delete specified station data from StationRepository
     *
     * @param string $id
     *
     * @return mixed
     */

    public function handleDeleteStation(string $id): mixed
    {
        return $this->repository->destroy($id);
    }
}
