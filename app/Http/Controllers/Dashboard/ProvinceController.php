<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\District;
use App\Models\Province;
use App\Services\ProvinceService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class ProvinceController extends Controller
{
    private ProvinceService $service;

    public function __construct(ProvinceService $provinceService)
    {
        $this->service = $provinceService;
    }

    /**
     * Get all regencies by specified Province id.
     *
     * @param Province $province
     *
     * @return JsonResponse
     */

    public function getAllRegencies(Province $province): JsonResponse
    {
        return response()->json($this->service->handleGetAllRegencies($province->id));
    }
}
