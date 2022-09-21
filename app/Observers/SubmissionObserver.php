<?php

namespace App\Observers;

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
     * Handle the Submission "updated" event.
     *
     * @param Submission $submission
     * @return void
     */
    public function updated(Submission $submission)
    {
        //
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
