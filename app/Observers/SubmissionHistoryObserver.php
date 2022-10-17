<?php

namespace App\Observers;

use App\Models\SubmissionHistory;
use Faker\Provider\Uuid;

class SubmissionHistoryObserver
{
    /**
     * Handle the SubmissionHistory "created" event.
     *
     * @param SubmissionHistory $submissionHistory
     * @return void
     */
    public function creating(SubmissionHistory $submissionHistory): void
    {
        $submissionHistory->id = Uuid::uuid();
    }
}
