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
        } else if (UserHelper::checkRolePetugas()) {
            $submission->validated_by_petugas = auth()->id();
        } else if (UserHelper::checkRoleKepalaDinas()) {
            $submission->validated_by_kepala_dinas = auth()->id();
        }
    }

    /**
     * Handle the Submission "deleted" event.
     *
     * @param Submission $submission
     * @return void
     */
    public function deleted(Submission $submission)
    {
        //
    }

    /**
     * Handle the Submission "restored" event.
     *
     * @param Submission $submission
     * @return void
     */
    public function restored(Submission $submission)
    {
        //
    }

    /**
     * Handle the Submission "force deleted" event.
     *
     * @param Submission $submission
     * @return void
     */
    public function forceDeleted(Submission $submission)
    {
        //
    }
}
