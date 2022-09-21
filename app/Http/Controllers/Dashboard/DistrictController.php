<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Services\DistrictService;
use Illuminate\Http\JsonResponse;

class DistrictController extends Controller
{
    private DistrictService $service;

    public function __construct(DistrictService $districtService)
    {
        $this->service = $districtService;
    }

    /**
     * Get all villages by specified district id.
     *
     * @param District $district
     *
     * @return JsonResponse
     */

    public function getAllVillages(District $district): JsonResponse
    {
        return response()->json($this->service->handleGetAllVillages($district->id));
    }
}
