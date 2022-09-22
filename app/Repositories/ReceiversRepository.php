<?php

namespace App\Repositories;

use App\Models\Receiver;
use App\Models\SubmissionReceiver;
use Faker\Provider\Uuid;

class ReceiversRepository extends BaseRepository
{
    private SubmissionReceiver $submissionReceiver;

    public function __construct(Receiver $receiver, SubmissionReceiver $submissionReceiver)
    {
        $this->model = $receiver;
        $this->submissionReceiver = $submissionReceiver;
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
     * Handle store data event to models.
     *
     * @param array $data
     *
     * @return mixed
     */


    public function store(array $data): mixed
    {
        $new = $this->model->create($data);

        $this->submissionReceiver->create([
            'id' => Uuid::uuid(),
            'receiver_id' => $new['id'],
            'submission_id' => $data['submission_id']
        ]);

        return $new;
    }
}
