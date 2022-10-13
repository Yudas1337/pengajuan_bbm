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

    /**
     * Handle get receiver by nik
     * 
     * @param string nik
     * 
     * @return object|null
     */
    public function getByNik(string $nik) : object|null
    {
        return $this->model->where('national_identity_number', $nik)->first();
    }
}
