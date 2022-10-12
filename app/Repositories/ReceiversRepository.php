<?php

namespace App\Repositories;

use App\Http\Resources\ReceiverResource;
use App\Models\Receiver;

class ReceiversRepository extends BaseRepository
{

    public function __construct(Receiver $receiver)
    {
        $this->model = $receiver;
    }

    /**
     * Handle the Get all data event from models.
     *
     * @return mixed
     */

    public function getAll(): mixed
    {
        return $this->model->query();
    }

    /**
     * Handle get the specified data by id from models.
     *
     * @param mixed $id
     *
     * @return mixed
     */

    public function show(mixed $id): mixed
    {
        $data = $this->model->query()
            ->where('national_identity_number', $id)
            ->with(['submission_receivers' => function ($q) {
                return $q->with(['submission' => function ($q) {
                    return $q->with('station')
                        ->latest('end_time');
                }, 'user']);
            }, 'group'])
            ->firstOrFail();
        return ReceiverResource::make($data);
    }
}
