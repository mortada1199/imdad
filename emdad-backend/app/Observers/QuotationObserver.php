<?php

namespace App\Observers;

use App\Models\Quotations\Quotation;

class QuotationObserver
{
    /**
     * Handle the Quotation "created" event.
     *
     * @param  \App\Models\Quotations\Quotation  $quotation
     * @return void
     */
    public function created(Quotation $quotation)
    {
        //
    }

    /**
     * Handle the Quotation "updated" event.
     *
     * @param  \App\Models\Quotations\Quotation  $quotation
     * @return void
     */
    public function updated(Quotation $quotation)
    {
        //
    }

    /**
     * Handle the Quotation "deleted" event.
     *
     * @param  \App\Models\Quotations\Quotation  $quotation
     * @return void
     */
    public function deleted(Quotation $quotation)
    {
        //
    }

    /**
     * Handle the Quotation "restored" event.
     *
     * @param  \App\Models\Quotations\Quotation  $quotation
     * @return void
     */
    public function restored(Quotation $quotation)
    {
        //
    }

    /**
     * Handle the Quotation "force deleted" event.
     *
     * @param  \App\Models\Quotations\Quotation  $quotation
     * @return void
     */
    public function forceDeleted(Quotation $quotation)
    {
        //
    }
}
