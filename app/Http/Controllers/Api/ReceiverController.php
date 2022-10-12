<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Services\ReceiversService;
use Illuminate\Http\JsonResponse;

class ReceiverController extends Controller
{
    private ReceiversService $service;

    public function __construct(ReceiversService $receiversService)
    {
        $this->service = $receiversService;
    }

    /**
     * Display the specified resource.
     *
     * @param string $nik
     *
     * @return JsonResponse
     */

    public function show(string $nik): JsonResponse
    {
        $data = $this->service->handleShowReceiver($nik);
        return ResponseFormatter::success($data, "Berhasil fetch receiver");
    }
}
