<?php

namespace App\Console\Commands;

use App\Models\SubmissionReceiver;
use Illuminate\Console\Command;

class ResetQuotaCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'receiver:reset-quota';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset receiver quota per day';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $datas = SubmissionReceiver::query()
            ->select('submission_receivers.id', 'receiver_id', 'submission_id', 'quota', 'submission_receivers.status', 'start_time', 'end_time', 'default_quota', 'validated_by_kepala_dinas')
            ->join('submissions', 'submissions.id', '=', 'submission_receivers.submission_id')
            ->whereDate('start_time', '<=', now())
            ->whereDate('end_time', '>=', now())
            ->whereNotNull('validated_by_kepala_dinas')
            ->active()
            ->get();

        foreach ($datas as $data) $data->update(['quota' => $data->default_quota]);
    }
}
