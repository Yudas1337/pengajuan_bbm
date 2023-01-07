<?php

namespace App\Repositories;

use App\Models\Submission;
use App\Models\SubmissionHistory;
use App\Models\SubmissionReceiver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubmissionRepository extends BaseRepository
{
    private SubmissionReceiver $submissionReceiver;
    private SubmissionHistory $submissionHistory;

    public function __construct(Submission $submission, SubmissionReceiver $submissionReceiver, SubmissionHistory $submissionHistory)
    {
        $this->model = $submission;
        $this->submissionReceiver = $submissionReceiver;
        $this->submissionHistory = $submissionHistory;
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
            ->with('group.user')
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
            'name' => $data['name'], 'national_identity_number' => $data['nik'], 'status' => $data['status']
        ]);
    }

    /**
     * Handle Get all trashed submissions from SubmissionEvent Model
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
            ->with('group.user')
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
        $data = $this->model->query()
            ->with(['group', 'user', 'user_last_update_by'])
            ->whereHas('group')
            ->verified()
            ->where('submissions.district_id', $districtId)
            ->whereNotNull('validated_by_penyuluh')
            ->latest('submissions.created_at')
            ->get();

        dd($data);
        return $data;
    }

    /**
     * get submission by admin tangkap
     *
     * @return mixed
     */

    public function getVerifiedSubmissionByTangkap(): mixed
    {
        return $this->model->query()
            ->with(['user', 'user_last_update_by', 'group'])
            ->whereHas('group')
            ->whereRelation('group', 'receiver_type', '=', 'Nelayan')
            ->verified()
            ->whereNotNull('validated_by_petugas')
            ->latest('submissions.created_at');
    }

    /**
     * get submission by admin pembudidaya
     *
     * @return mixed
     */

    public function getVerifiedSubmissionByPembudidaya(): mixed
    {
        return $this->model->query()
            ->with(['group', 'user', 'user_last_update_by'])
            ->whereHas('group')
            ->whereRelation('group', 'receiver_type', '=', 'Pembudidaya')
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
            ->with(['group', 'user', 'user_last_update_by'])
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
            ->with(['group', 'user', 'user_last_update_by'])
            ->whereHas('group')
            ->where('submissions.district_id', $districtId)
            ->whereNull('validated_by_penyuluh')
            ->latest('submissions.created_at');
    }

    /**
     * get unverified submission by admin tangkap
     *
     * @return mixed
     */

    public function getUnverifiedSubmissionByTangkap(): mixed
    {
        return $this->model->query()
            ->with(['group', 'user', 'user_last_update_by'])
            ->whereHas('group')
            ->whereRelation('group', 'receiver_type', '=', 'Nelayan')
            ->whereNotNull('validated_by_penyuluh')
            ->whereNull('validated_by_petugas')
            ->latest('submissions.created_at');
    }

    /**
     * get unverified submission by admin pembudidaya
     *
     * @return mixed
     */

    public function getUnverifiedSubmissionByPembudidaya(): mixed
    {
        return $this->model->query()
            ->with(['group.user', 'user', 'user_last_update_by'])
            ->whereHas('group')
            ->whereRelation('group', 'receiver_type', '=', 'Pembudidaya')
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
            ->with(['group', 'user', 'user_last_update_by'])
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

    public function handleGetTotalQuota(string $submission_id): int
    {
        return $this->submissionReceiver->query()
            ->where('submission_id', $submission_id)
            ->sum('quota');
    }

    /**
     * handle check station submission by id
     *
     * @param string $submission_id
     *
     * @return object
     *
     */

    /**
     * handle count verified submission from model
     *
     * @return int
     *
     */

    public function countVerifiedSubmission(): int
    {
        return $this->model->query()
            ->verified()
            ->whereNotNull('validated_by_kepala_dinas')
            ->count();
    }

    /**
     * handle count unverified submission from model
     *
     * @return int
     *
     */

    public function countUnverifiedSubmission(): int
    {
        return $this->model->query()
            ->whereNull('validated_by_kepala_dinas')
            ->whereNotNull('validated_by_petugas')
            ->count();
    }

    /**
     * handle count unverified submission from model
     *
     * @return int
     *
     */

    public function countRejectedSubmission(): int
    {
        return $this->model->query()
            ->whereNotNull('approval_message')
            ->count();
    }

    /**
     * handle count total quota submission from model
     *
     * @return int
     *
     */

    public function countTotalQuota(): int
    {
        return $this->submissionReceiver->query()
            ->active()
            ->sum('default_quota');
    }

    /**
     * handle count total quota transaction from model
     *
     * @return int
     *
     */

    public function countQuotaTransaction(): int
    {
        return $this->submissionHistory->query()
            ->sum('quota_cost');
    }

    /**
     * handle get transactions history from model
     *
     * @return object|null
     *
     */

    public function getTransactions(Request $request): object|null
    {
        $date = explode(' - ', $request->date);
        $start = date($date[0]);
        $end = date($date[1]);
        return  $this->submissionHistory->query()
            ->selectRaw('submission_histories.*, submission_histories.created_at as submmission_history_created')
            ->with(['submission_receiver.receiver', 'user.station'])
            ->when($request->date, function ($q) use ($start, $end) {
                return $q->whereBetween('submission_histories.created_at', [$start . ' 00:00:00', $end . ' 23:59:59']);
            })
            ->latest();
    }

    /**
     * handle get transactions history from model by date
     *
     * @return mixed
     *
     */

    public function getTransactionsByDate(string $daterange): mixed
    {
        $date = explode(' - ', $daterange);
        $start = date($date[0]);
        $end = date($date[1]);
        return $this->submissionHistory->query()
            ->selectRaw('submission_histories.*, submission_histories.created_at as submmission_history_created')
            ->with(['submission_receiver.receiver', 'user.station'])
            ->when($daterange, function ($q) use ($start, $end) {
                return $q->whereBetween('submission_histories.created_at', [$start . ' 00:00:00', $end . ' 23:59:59']);
            })
            ->latest()
            ->get();
    }

    /**
     * handle count quota by district
     *
     * @return object
     */

    public function countQuotaByDistrict(): object
    {
        return $this->model->query()
            ->select('id')
            ->where('district_id', auth()->user()->district_id)
            ->verified()
            ->whereDate('start_time', '<=', now())
            ->whereDate('end_time', '>=', now())
            ->withSum('submission_receivers', 'default_quota')
            ->get();
    }

    /**
     * handle count unverified submission by district
     *
     * @return int
     */

    public function countUnverifiedSubmissionByDistrict(): int
    {
        return $this->model->query()
            ->where('district_id', auth()->user()->district_id)
            ->whereNull('validated_by_penyuluh')
            ->count();
    }

    /**
     * handle count total submission this year
     *
     * @return int
     */

    public function countTotalSubmissionThisYear(): int
    {
        return $this->model->query()
            ->where(DB::raw('YEAR(created_at)'), now()->format('Y'))
            ->where('created_by', auth()->id())
            ->count();
    }

    /**
     * handle count accepted quota this year
     *
     * @return object
     */

    public function countAcceptedQuotaThisYear(): object
    {
        return $this->model->query()
            ->select('id')
            ->where(DB::raw('YEAR(created_at)'), now()->format('Y'))
            ->where('created_by', auth()->id())
            ->has('submission_receivers')
            ->withSum('submission_receivers', 'default_quota')
            ->get();
    }

    /**
     * handle process submission
     *
     * @return int
     */

    public function countProgressSubmission(): int
    {
        return $this->model->query()
            ->select('id', 'start_time', 'end_time', 'created_by')
            ->where('created_by', auth()->id())
            ->whereNotNull('validated_by_penyuluh')
            ->whereNull('start_time')
            ->whereNull('end_time')
            ->count();
    }

    /**
     * handle declined submission
     *
     * @return int
     */

    public function countDeclinedSubmission(): int
    {
        return $this->model->query()
            ->select('id', 'approval_message', 'created_by')
            ->whereNotNull('approval_message')
            ->where('created_by', auth()->id())
            ->count();
    }

    /**
     * get submission report
     *
     * @return mixed
     */

    public function getSubmissionReport(Request $request): mixed
    {
        $date = explode(' - ', $request->date);
        $start = date($date[0]);
        $end = date($date[1]);
        return $this->model->query()
            ->withCount('submission_receivers')
            ->withSum('submission_receivers', 'quota')
            ->with(['group.user.district', 'user', 'user_last_update_by'])
            ->whereHas('group')
            ->verified()
            ->whereNotNull('validated_by_kepala_dinas')
            ->when($request->date, function ($q) use ($start, $end) {
                return $q->whereBetween('submissions.created_at', [$start . ' 00:00:00', $end . ' 23:59:59']);
            })
            ->latest('submissions.created_at');
    }
}
