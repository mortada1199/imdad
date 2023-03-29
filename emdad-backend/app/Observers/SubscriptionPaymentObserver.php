<?php

namespace App\Observers;

use App\Models\SubscriptionPayment;

class SubscriptionPaymentObserver
{
    /**
     * Handle the SubscriptionPayment "created" event.
     *
     * @param  \App\Models\SubscriptionPayment  $subscriptionPayment
     * @return void
     */
    public function created(SubscriptionPayment $subscriptionPayment)
    {
        //
    }

    /**
     * Handle the SubscriptionPayment "updated" event.
     *
     * @param  \App\Models\SubscriptionPayment  $subscriptionPayment
     * @return void
     */
    public function updated(SubscriptionPayment $subscriptionPayment)
    {
        //
     
    }

    /**
     * Handle the SubscriptionPayment "deleted" event.
     *
     * @param  \App\Models\SubscriptionPayment  $subscriptionPayment
     * @return void
     */
    public function deleted(SubscriptionPayment $subscriptionPayment)
    {
        //
    }

    /**
     * Handle the SubscriptionPayment "restored" event.
     *
     * @param  \App\Models\SubscriptionPayment  $subscriptionPayment
     * @return void
     */
    public function restored(SubscriptionPayment $subscriptionPayment)
    {
        //
    }

    /**
     * Handle the SubscriptionPayment "force deleted" event.
     *
     * @param  \App\Models\SubscriptionPayment  $subscriptionPayment
     * @return void
     */
    public function forceDeleted(SubscriptionPayment $subscriptionPayment)
    {
        //
    }
}
