<?php

namespace App\Observers;

use App\Http\Controllers\Auth\MailController;
use App\Http\Controllers\SmsController;
use App\Http\Services\General\SmsService;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Notifications\VerifyEmail;
use App\Mail\WelcomeMail;
use App\Models\Settings\Setting;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class UserObserver
{
    protected SmsService $sms;

    public function __construct(SmsService $smsService)
    {
        $this->sms = $smsService;
    }
    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\UM\User  $User
     * @return void         
     */
    public function created(User $User)
    {
       $defaultSettings= ["lang"=> "En", "showTime"=> true, "showTraning"=> true];

        Setting::updateOrCreate(['user_id' => $User->id,  'preferences' => json_encode($defaultSettings,true)]);



        $this->sms->sendOtp($User->name, $User->mobile, $User->otp);

        // MailController::sendSignupEmail($User->name, $User->email, $User->otp);
        // SmsController::sendSms($User->name, $User->mobile, $User->otp, $this->sms);
        // if ($User instanceof MustVerifyEmail && ! $User->hasVerifiedEmail()) {
        //     $User->sendEmailVerificationNotification();
        // }
        //
        // SendEmailVerificationNotification::class;
        // Mail::to($User->email)->send(new VerifyEmail());
        // return response()->json([
        //     'status'=>200,
        //     'message'=>'User Has Been Created Successfully'
        // ]);

    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\User  $User
     * @return void
     */
    public function updated(User $User)
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\User  $User
     * @return void
     */
    public function deleted(User $User)
    {
        //
    }

    /**
     * Handle the User "restored" event.
     *
     * @param  \App\Models\User  $User
     * @return void
     */
    public function restored(User $User)
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param  \App\Models\User  $User
     * @return void
     */
    public function forceDeleted(User $User)
    {
        //
    }
}
