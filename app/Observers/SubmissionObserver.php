<?php

namespace App\Observers;

use App\Events\SubmissionEvent;
use App\Helpers\UserHelper;
use App\Models\Submission;

class SubmissionObserver
{
    /**
     * Handle the SubmissionEvent "creating" event.
     *
     * @param Submission $submission
     * @return void
     */
    public function creating(Submission $submission): void
    {
        $submission->created_by = auth()->id();
        if (UserHelper::checkRolePenyuluh()) {
            $submission->status = 1;
        } else if (UserHelper::checkRolePembudidaya()) {
            $submission->status = 1;
        } else if (UserHelper::checkRoleTangkap()) {
            $submission->status = 1;
        } else if (UserHelper::checkRoleKepalaDinas()) {
            $submission->status = 1;
        }
    }

    /**
     * Handle the SubmissionEvent "updating" event.
     *
     * @param Submission $submission
     * @return void
     */
    public function updating(Submission $submission)
    {
        if (UserHelper::checkRolePenyuluh()) {
            $submission->validated_by_penyuluh = auth()->id();
            $submission->status = 1;
        } else if (UserHelper::checkRolePembudidaya() || UserHelper::checkRoleTangkap()) {
            $submission->validated_by_petugas = auth()->id();
        } else if (UserHelper::checkRoleKepalaDinas()) {
            $user = [
                'id' => $submission->id,
                'type' => null,
                'message' => null,
                'group_name' => $submission->group()->first()->group_name,
                'url' => route('submission.verified_detail', $submission->id),
                'timestamp' => now()
            ];

            if (request()->approval_message === null) {
                $submission->approval_message = null;
                $submission->validated_by_kepala_dinas = auth()->id();
                $submission->start_time = now();
                $submission->end_time = now()->addMonths(1);
                $submission->submission_receivers()->update([
                    'status' => 1,
                    'validated_by' => auth()->id(),
                    'validated_at' => now()
                ]);

                $user['type'] = 'accepted';
                $user['message'] = 'Pengajuan pada kelompok ' . $user['group_name'] . ' telah disetujui.';
                event(new SubmissionEvent($user));
            } else {
                $submission->validated_by_penyuluh = null;
                $submission->validated_by_petugas = null;
                $user['type'] = 'rejected';
                $user['message'] = 'Pengajuan pada kelompok ' . $user['group_name'] . ' ditolak. Klik untuk melihat detail penolakan';
                event(new SubmissionEvent($user));
            }

            $submission->last_update_by = auth()->id();
        }

    }
}
