<?php

namespace App\Observers;

use App\Models\Station;
use Faker\Provider\Uuid;

class StationObserver
{
    /**
     * Handle the Station "creating" event.
     *
     * @param Station $station
     *
     * @return void
     */
    public function creating(Station $station): void
    {
        $station->id = Uuid::uuid();
    }
}
