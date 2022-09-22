<?php

namespace App\Observers;

use App\Models\Receiver;
use Faker\Provider\Uuid;

class ReceiverObserver
{
    /**
     * Handle the Receiver "creating" event.
     *
     * @param  \App\Models\Receiver  $receiver
     * @return void
     */
    public function creating(Receiver $receiver)
    {
        $receiver->id = Uuid::uuid();
    }
}
