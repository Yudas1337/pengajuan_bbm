<?php

namespace App\Services\Api;

use App\Repositories\TransactionRepository;

class TransactionHistoryService
{
    private TransactionRepository $repository;

    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->repository = $transactionRepository;
    }

    /**
     * Handle Get Transaction History from TransactionRepository.
     *
     * @param string $receiver_id
     *
     * @return object
     */

    public function handleGetTransactionHistory(string $receiver_id): object
    {
        return $this->repository->getTransactionHistory($receiver_id);
    }
}
