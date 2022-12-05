<?php

namespace App\Services\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Requests\Api\QuotaTransactionRequest;
use App\Repositories\BaseRepository;
use App\Repositories\TransactionRepository;
use Illuminate\Http\JsonResponse;

class TransactionService extends BaseRepository
{
    private TransactionRepository $repository;

    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->repository = $transactionRepository;
    }

    /**
     * Handle Check Requirement before doing Quota Transaction from TransactionRepository.
     *
     * @param QuotaTransactionRequest $request
     *
     * @return mixed
     */

    public function handleCheckRequirements(QuotaTransactionRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user_station_id = auth()->user()->station_id;

        $submission = $this->repository->handleCheckSubmission($data['submission_id'], $data['receiver_id']);
        $valid_station = $this->repository->handleCheckStation($data['submission_id'], $data['receiver_id'], $user_station_id);
        $quota_remaining = $this->repository->handleCheckQuota($data['submission_id'], $data['receiver_id'], $data['quota_cost']);

        if (!$submission) {
            return ResponseFormatter::error(null, "Gagal! Masa pengajuan telah berakhir");
        }

        if (!$quota_remaining) {
            return ResponseFormatter::error(null, "Gagal! Kuota tidak mencukupi");
        }

        if ($data['type'] == 'spbn') {
            return $this->handleQuotaTransaction($request);
        }

        if (!$valid_station) {
            return ResponseFormatter::error(null, "Gagal! SPBU tidak sesuai dengan record pengajuan");
        }

        return $this->handleQuotaTransaction($request);
    }

    /**
     * Handle Quota Transaction from TransactionRepository.
     *
     * @param QuotaTransactionRequest $request
     *
     * @return JsonResponse
     */

    public function handleQuotaTransaction(QuotaTransactionRequest $request): JsonResponse
    {
        $data = $request->validated();

        $submission = $this->repository->handleCheckSubmission($data['submission_id'], $data['receiver_id']);

        $updated_quota = $submission->quota - $data['quota_cost'];

        $this->repository->reduceReceiverQuota($data['submission_id'], $data['receiver_id'], $updated_quota);
        $this->repository->store([
            'submission_receiver_id' => $submission->id,
            'quota_cost' => $data['quota_cost'],
            'user_id' => auth()->id()
        ]);
        return ResponseFormatter::success(null, "Berhasil melakukan transaksi");
    }
}
