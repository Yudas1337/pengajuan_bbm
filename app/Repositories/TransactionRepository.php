<?php

namespace App\Repositories;

use App\Http\Resources\SubmissionHistoryResource;
use App\Models\SubmissionHistory;
use App\Models\SubmissionReceiver;

class TransactionRepository extends BaseRepository
{
    private SubmissionReceiver $submissionReceiver;

    public function __construct(SubmissionHistory $submissionHistory, SubmissionReceiver $submissionReceiver)
    {
        $this->model = $submissionHistory;
        $this->submissionReceiver = $submissionReceiver;
    }

    /**
     * Check if submission is exists via model.
     *
     * @param string $submission_id
     * @param string $receiver_id
     *
     * @return mixed
     */

    public function handleCheckSubmission(string $submission_id, string $receiver_id)
    {
        return $this->submissionReceiver->query()
            ->select('submission_receivers.id', 'receiver_id', 'submission_id', 'quota', 'submission_receivers.status', 'start_time', 'end_time', 'validated_by_kepala_dinas')
            ->join('submissions', 'submissions.id', '=', 'submission_receivers.submission_id')
            ->where(['submission_id' => $submission_id, 'receiver_id' => $receiver_id])
            ->whereDate('start_time', '<=', now())
            ->whereDate('end_time', '>=', now())
            ->whereNotNull('validated_by_kepala_dinas')
            ->active()
            ->first();
    }

    /**
     * Check station id from receiver via model.
     *
     * @param string $submission_id
     * @param string $receiver_id
     * @param string $user_station_id
     *
     * @return mixed
     */

    public function handleCheckStation(string $submission_id, string $receiver_id, string $user_station_id)
    {
        return $this->submissionReceiver->query()
            ->join('submissions', 'submissions.id', '=', 'submission_receivers.submission_id')
            ->where(['submission_id' => $submission_id, 'receiver_id' => $receiver_id, 'station_id' => $user_station_id])
            ->active()
            ->first();
    }

    /**
     * Check quota remaining from receiver via model.
     *
     * @param string $submission_id
     * @param string $receiver_id
     * @param string $quota_cost
     *
     * @return mixed
     */

    public function handleCheckQuota(string $submission_id, string $receiver_id, string $quota_cost)
    {
        return $this->submissionReceiver->query()
            ->where(['submission_id' => $submission_id, 'receiver_id' => $receiver_id])
            ->where('quota', '>=', $quota_cost)
            ->active()
            ->first();
    }

    /**
     * Reduce quota transaction from receiver via model.
     *
     * @param string $submission_id
     * @param string $receiver_id
     * @param string $updated_quota
     *
     * @return mixed
     */

    public function reduceReceiverQuota(string $submission_id, string $receiver_id, string $updated_quota)
    {
        return $this->submissionReceiver->query()
            ->where(['submission_id' => $submission_id, 'receiver_id' => $receiver_id])
            ->active()
            ->first()
            ->update(['quota' => $updated_quota]);
    }

    /**
     * Get transaction history from submission history via model.
     *
     * @param string $receiver_id
     *
     * @return object
     */

    public function getTransactionHistory(string $receiver_id): object
    {
        return SubmissionHistoryResource::collection($this->model->query()
            ->whereRelation('submission_receiver', 'receiver_id', '=', $receiver_id)
            ->with(['user'])
            ->take(10)
            ->latest()
            ->get());
    }
}
