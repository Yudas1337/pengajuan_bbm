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
            ->select('id', 'group_id', 'status', 'start_time', 'end_time')
            ->with('group.user')
            ->whereHas('group')
            ->author()
            ->latest();
    }

    /**
     * Handle store or update data event to models.
     *
     * @param array $data
     *
     * @return mixed
     */

    public function storeOrUpdate(array $data): mixed
    {
        $data['updated_at'] = now();
        return $this->model->updateOrCreate(
            [
                'id' => $data['submission_id']
            ],
            $data
        );
    }

    /**
     * Handle the Get all receiver by submission id from model.
     *
     * @param string $id
     *
     * @return object
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

    /**
     * Handle Get all trashed submissions from Submission Model
     *
     * @return object|null
     */

    public function getTrashedSubmission(): mixed
    {
        return $this->trashed();
    }

    /**
     * Handle get trashed submission instantly from models.
     *
     * @return mixed
     */

    public function trashed(): mixed
    {
        return $this->model->query()
            ->select('id', 'group_id')
            ->where('created_by', auth()->id())
            ->onlyTrashed();
    }

    /**
     * Handle restore submission by given id instantly from models.
     *
     * @param string $id
     *
     * @return mixed
     */

    public function restoreSubmission(string $id): mixed
    {
        return $this->model->query()
            ->onlyTrashed()
            ->where('id', $id)->restore();
    }

    /**
     * get submission by penyuluh
     *
     * @param string $districtId
     *
     * @return mixed
     */

    public function getVerifiedSubmissionByPenyuluh(string $districtId): mixed
    {
        return $this->model->query()
            ->select('id', 'group_id', 'status', 'start_time', 'end_time', 'created_by')
            ->with(['group.user', 'user'])
            ->whereHas('group')
            ->verified()
            ->where('submissions.district_id', $districtId)
            ->whereNotNull('validated_by_penyuluh')
            ->latest('submissions.created_at');
    }

    /**
     * get submission by petugas
     *
     * @return mixed
     */

    public function getVerifiedSubmissionByPetugas(): mixed
    {
        return $this->model->query()
            ->select('id', 'group_id', 'status', 'start_time', 'end_time', 'created_by')
            ->with(['group.user', 'user'])
            ->whereHas('group')
            ->verified()
            ->whereNotNull('validated_by_petugas')
            ->latest('submissions.created_at');
    }

    /**
     * get verified submission by kepala dinas
     * 
     * @return mixed
     */

    public function getVerifiedSubmissionByKepalaDinas(): mixed
    {
        return $this->model->query()
            ->select('id', 'group_id', 'status', 'start_time', 'end_time', 'created_by')
            ->with(['group.user', 'user'])
            ->whereHas('group')
            ->verified()
            ->whereNotNull('validated_by_kepala_dinas')
            ->latest('submissions.created_at');
    }

    /**
     * get unverified submission by penyuluh
     *
     * @param string $districtId
     *
     * @return mixed
     */

    public function getUnverifiedSubmissionByPenyuluh(string $districtId): mixed
    {
        return $this->model->query()
            ->select('id', 'group_id', 'status', 'start_time', 'end_time', 'created_by')
            ->with(['group.user', 'user'])
            ->whereHas('group')
            ->where('submissions.district_id', $districtId)
            ->whereNull('validated_by_penyuluh')
            ->latest('submissions.created_at');
    }

    /**
     * get unverified submission by petugas
     *
     * @return mixed
     */

    public function getUnverifiedSubmissionByPetugas(): mixed
    {
        return $this->model->query()
            ->select('id', 'group_id', 'status', 'start_time', 'end_time', 'created_by')
            ->with(['group.user', 'user'])
            ->whereHas('group')
            ->whereNotNull('validated_by_penyuluh')
            ->whereNull('validated_by_petugas')
            ->latest('submissions.created_at');
    }

    /**
     * get unverified submission by kepala dinas
     * 
     * @return mixed
     */

    public function getUnverifiedSubmissionByKepalaDinas(): mixed
    {
        return $this->model->query()
            ->select('id', 'group_id', 'status', 'start_time', 'end_time', 'created_by')
            ->with(['group.user', 'user'])
            ->whereHas('group')
            ->whereNotNull('validated_by_petugas')
            ->whereNull('validated_by_kepala_dinas')
            ->latest('submissions.created_at');
    }

    /**
     * handle get total quota
     * 
     * @param string $submission_id
     * 
     * @return int
     * 
     */

    public function handleGetTotalQuota(string $submission_id) : int
    {
        return $this->submissionReceiver->query()
        ->where('submission_id', $submission_id)
        ->sum('quota');
    }
}
