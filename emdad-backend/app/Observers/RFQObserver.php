<?php

namespace App\Observers;

use App\Models\RFQ\Rfq;

class RFQObserver
{
    /**
     * Handle the Rfq "created" event.
     *
     * @param  \App\Models\Rfq  $rfq
     * @return void
     */
    public function created(Rfq $rfq)
    {
        //
        
    }

    /**
     * Handle the Rfq "updated" event.
     *
     * @param  \App\Models\Rfq  $rfq
     * @return void
     */
    public function updated(Rfq $rfq)
    {
        //
    }

    /**
     * Handle the Rfq "deleted" event.
     *
     * @param  \App\Models\Rfq  $rfq
     * @return void
     */
    public function deleted(Rfq $rfq)
    {
        //
    }

    /**
     * Handle the Rfq "restored" event.
     *
     * @param  \App\Models\Rfq  $rfq
     * @return void
     */
    public function restored(Rfq $rfq)
    {
        //
    }

    /**
     * Handle the Rfq "force deleted" event.
     *
     * @param  \App\Models\Rfq  $rfq
     * @return void
     */
    public function forceDeleted(Rfq $rfq)
    {
        //
    }
}
