<?php

namespace App\Observers;

use App\Events\JiriCreatedEvent;
use App\Models\Jiri;

class JiriObserver
{
    /**
     * Handle the Jiri "created" event.
     */
    public function created(Jiri $jiri): void
    {
        event(new JiriCreatedEvent($jiri));
    }

    /**
     * Handle the Jiri "updated" event.
     */
    public function updated(Jiri $jiri): void
    {
        //
    }

    /**
     * Handle the Jiri "deleted" event.
     */
    public function deleted(Jiri $jiri): void
    {
        //
    }

    /**
     * Handle the Jiri "restored" event.
     */
    public function restored(Jiri $jiri): void
    {
        //
    }

    /**
     * Handle the Jiri "force deleted" event.
     */
    public function forceDeleted(Jiri $jiri): void
    {
        //
    }
}
