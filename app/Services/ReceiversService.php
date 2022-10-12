<?php

namespace App\Services;

use App\Http\Requests\ReceiverRequest;
use App\Repositories\ReceiversRepository;
use App\Traits\YajraTable;

class ReceiversService
{
    use YajraTable;

    private ReceiversRepository $repository;

    public function __construct(ReceiversRepository $receiversRepository)
    {
        $this->repository = $receiversRepository;
    }

    /**
     * Get all receivers from ReceiversRepository with yajra table
     *
     * @return object|null
     */

    public function handleGetReceivers(): object|null
    {
        return $this->ReceiversMockup($this->repository->getAll());
    }

    /**
     * Store receiver data to receiverRepository
     *
     * @param ReceiverRequest $request
     *
     * @return void
     */

    public function handleStoreReceiver(ReceiverRequest $request): void
    {
        $this->repository->store($request->validated());
    }

    /**
     * update receiver data by given id to receiverRepository
     *
     * @param ReceiverRequest $request
     * @param string $id
     *
     * @return void
     */

    public function handleUpdateReceiver(ReceiverRequest $request, string $id): void
    {
        $this->repository->update($id, $request->validated());
    }

    /**
     * Delete receiver from receiverRepository
     *
     * @param string $id
     *
     * @return mixed
     */

    public function handleDeleteReceiver(string $id): mixed
    {
        return $this->repository->destroy($id);
    }

    /**
     * Show receiver using specified nik from receiverRepository
     *
     * @param string $nik
     *
     * @return object
     */

    public function handleShowReceiver(string $nik): object
    {
        return $this->repository->show($nik);
    }
}
