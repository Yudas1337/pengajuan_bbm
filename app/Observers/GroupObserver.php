<?php

namespace App\Observers;

use App\Models\Group;
use Faker\Provider\Uuid;

class GroupObserver
{
    /**
     * Handle the Group "creating" event.
     *
     * @param  \App\Models\Group  $group
     * @return void
     */
    public function creating(Group $group)
    {
        $group->id = Uuid::uuid();
    }

    /**
     * Handle the Group "updated" event.
     *
     * @param  \App\Models\Group  $group
     * @return void
     */
    public function updated(Group $group)
    {
        //
    }

    /**
     * Handle the Group "deleted" event.
     *
     * @param  \App\Models\Group  $group
     * @return void
     */
    public function deleted(Group $group)
    {
        //
    }

    /**
     * Handle the Group "restored" event.
     *
     * @param  \App\Models\Group  $group
     * @return void
     */
    public function restored(Group $group)
    {
        //
    }

    /**
     * Handle the Group "force deleted" event.
     *
     * @param  \App\Models\Group  $group
     * @return void
     */
    public function forceDeleted(Group $group)
    {
        //
    }
}
