<?php

namespace App\Repositories;

use App\Helpers\UserHelper;
use App\Http\Resources\ReceiverResource;
use App\Models\Receiver;
use Illuminate\Database\QueryException;

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
    public function getByNik(string $nik): object|null
    {
        return $this->model->where('national_identity_number', $nik)->first();
    }

    /**
     * Handle Delete the specified data by id from models.
     *
     * @param mixed $id
     *
     * @return mixed
     */

    public function DeleteReceiver(mixed $id): mixed
    {
        try {
            return $this->showReceiver($id)->delete($id);
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1451) return false;
        }
    }

    /**
     * Handle Get the specified data by id from models.
     *
     * @param mixed $id
     *
     * @return mixed
     */

    public function showReceiver(mixed $id): mixed
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Handle Update Receiver the specified data by id from models.
     *
     * @param mixed $id
     * @param array $data
     *
     * @return mixed
     */

    public function updateReceiver(mixed $id, array $data): mixed
    {
        return $this->model->findOrFail($id)->update($data);
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

    /**
     * Handle count all receiver data from models
     *
     * @return mixed
     */

    public function countAll(): mixed
    {
        return $this->model->query()
            ->when(UserHelper::checkRoleKetuaKelompok(), function ($q) {
                return $q->whereRelation('group', 'group_leader_id', '=', auth()->id());
            })
            ->count();
    }
}
