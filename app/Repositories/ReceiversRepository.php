<?php

namespace App\Repositories;

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
}
