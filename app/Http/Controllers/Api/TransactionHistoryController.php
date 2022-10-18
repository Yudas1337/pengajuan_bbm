<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Services\Api\TransactionHistoryService;
use Illuminate\Http\JsonResponse;

class TransactionHistoryController extends Controller
{
    private TransactionHistoryService $service;

    public function __construct(TransactionHistoryService $transactionHistoryService)
    {
        $this->service = $transactionHistoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param string $receiver_id
     *
     * @return JsonResponse
     */

    public function index(string $receiver_id): JsonResponse
    {
        $data = $this->service->handleGetTransactionHistory($receiver_id);
        return ResponseFormatter::success($data, "Berhasil fetch history transaksi");
    }
}
