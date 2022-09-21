<?php

namespace App\Repositories;

use App\Models\Receiver;
use App\Models\Submission;
use App\Models\SubmissionReceiver;

class SubmissionRepository extends BaseRepository
{
    private Receiver $receiver;
    private SubmissionReceiver $submissionReceiver;

    public function __construct(Submission $submission, Receiver $receiver, SubmissionReceiver $submissionReceiver)
    {
        $this->model = $submission;
        $this->receiver = $receiver;
        $this->submissionReceiver = $submissionReceiver;
    }

    /**
     * Handle the Get all data event from models.
     *
     *
     * @return mixed
     */

    public function getAll(): mixed
    {
        return $this->model->query()
            ->select('id', 'group_name', 'group_leader', 'letter_number', 'date', 'status');
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
        return $this->model->updateOrCreate(
            [
                'id' => $data['submission_id']
            ],
            $data
        );
    }

    /**
     * Handle the Get all data event from models.
     *
     * @param string $submission_id
     *
     * @return void
     */

    public function truncateReceiverData(string $submission_id): void
    {
        $receiver = $this->model->query()
            ->select('id')
            ->with('submission_receivers', function ($q) {
                return $q->select('submission_id', 'receiver_id')->get();
            })->findOrFail($submission_id);

        $receiver->submission_receivers()->each(function ($item) {
            $tmp = $item->receiver_id;
            $item->delete();
            $this->receiver->findOrFail($tmp)->delete();
        });
    }

    /**
     * Handle the Get all receiver by submission id from model.
     *
     * @param string $id
     *
     * @return void
     */

    public function getReceiverBySubmissionId(string $id): object
    {
        return $this->submissionReceiver->query()
            ->select('submission_id', 'quota', 'receiver_id', 'name', 'national_identity_number', 'receivers.status')
            ->join('receivers', 'receivers.id', '=', 'submission_receivers.receiver_id')
            ->whereIn('receivers.status', ['Draft', 'Perubahan', 'Tidak Valid'])
            ->where(['submission_id' => $id]);
    }

    /**
     * Handle store receivers data by give receiver_id and submission_id from model.
     *
     * @param string $receiver_id
     * @param string $submission_id
     * @param array $data
     *
     * @return void
     */

    public function storeReceivers(string $receiver_id, string $submission_id, array $data): void
    {
        $show = $this->submissionReceiver->where([
            'receiver_id' => $receiver_id, 'submission_id' => $submission_id
        ])->with('receiver')
            ->firstOrFail();

        $show->update(['quota' => $data['quota']]);
        $show->receiver()->update([
            'name' => $data['name'], 'national_identity_number' => $data['nik']
        ]);
    }
}
