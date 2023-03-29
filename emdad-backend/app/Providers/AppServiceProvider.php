<?php

namespace App\Providers;

use App\Models\Accounts\CompanyInfo;
use App\Models\Quotations\Quotation;
use App\Models\rfq\Rfq;
use App\Models\SubscriptionPayment;
use App\Models\User;
use App\Observers\AccountsObserver;
use App\Observers\QuotationObserver;
use App\Observers\RFQObserver;
use App\Observers\SubscriptionPaymentObserver;
use App\Observers\UserObserver;
use Database\Seeders\UOMSeeder;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Rfq::observe(RFQObserver::class);
        Quotation::observe(QuotationObserver::class);
        User::observe(UserObserver::class);
        CompanyInfo::observe(AccountsObserver::class);
        SubscriptionPayment::observe(SubscriptionPaymentObserver::class);
    }
}
