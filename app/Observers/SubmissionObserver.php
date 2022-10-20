<?php

namespace App\Observers;

use App\Helpers\UserHelper;
use App\Models\Submission;

class SubmissionObserver
{
    /**
     * Handle the Submission "creating" event.
     *
     * @param Submission $submission
     * @return void
     */
    public function creating(Submission $submission): void
    {
        $submission->created_by = auth()->id();
        if (UserHelper::checkRolePenyuluh()) {
            $submission->status = 1;
        } else if (UserHelper::checkRolePetugas()) {
            $submission->status = 1;
        } else if (UserHelper::checkRoleKepalaDinas()) {
            $submission->status = 1;
        }
    }

    /**
     * Handle the Submission "updating" event.
     *
     * @param Submission $submission
     * @return void
     */
    public function updating(Submission $submission)
    {
        if (UserHelper::checkRolePenyuluh()) {
            $submission->validated_by_penyuluh = auth()->id();
            $submission->status = 1;
        } else if (UserHelper::checkRolePetugas()) {
            $submission->validated_by_petugas = auth()->id();
        } else if (UserHelper::checkRoleKepalaDinas()) {
            if($submission->approval_message === null){
                $submission->validated_by_kepala_dinas = auth()->id();
                $submission->start_time = now();
                $submission->end_time = now()->addMonths(3);
                $submission->submission_receivers()->update([
                    'status' => 1,
                    'validated_by' => auth()->id(),
                    'validated_at' => now()
                ]);
            }
        }
        
    }
}
