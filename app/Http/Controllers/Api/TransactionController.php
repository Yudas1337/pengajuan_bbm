<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\QuotaTransactionRequest;
use App\Services\Api\TransactionService;
use Illuminate\Http\JsonResponse;

class TransactionController extends Controller
{
    private TransactionService $service;

    public function __construct(TransactionService $transactionService)
    {
        $this->service = $transactionService;
    }

    /**
     * Add Transaction By User using QrCode.
     *
     * @param QuotaTransactionRequest $request
     *
     * @return JsonResponse
     */

    public function addTransaction(QuotaTransactionRequest $request): JsonResponse
    {
        $this->authorize('record-transaction');

        $this->service->handleCheckRequirements($request);

        return ResponseFormatter::success(null, 'Berhasil melakukan transaksi');
    }
}
