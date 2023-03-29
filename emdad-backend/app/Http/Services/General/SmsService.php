<?php

namespace App\Http\Services\General;

use App\Models\AppSetting;
use App\Models\Settings\IntegrationResponse;

class SmsService
{

  public   function sendOtp($user)
  {

    # code...
    // $msgBody = "Your verification code is " . $user->otp;
    // sendSms($mobile, $msgBody);
    // $this->sendSms($user->mobile, $msgBody);
  }

  public  function sendSms($mobile, $var, $smsType = 'otp')
  {
    $template_id = null;
    if ($smsType === 'otp') {
      $msgBody = 'Your verification code is ' . $var . '';
      $template_id = AppSetting::where("key", "sms_otp_en")->first()->value ?? '';

    }
    if ($smsType == 'password') {
      $msgBody = 'Emdad account has been issued for you use this first time password ' . $var . '';
      $template_id = AppSetting::where("key", "sms_password_en")->first()->value ?? '';
    }


    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://rest.gateway.sa/api/SendSMS?api_id=API8853343069&api_password=Govb6nG0um&sms_type=T&sender_id=Emdad-Aid&phonenumber=' . $mobile . '&V1=' .$var . '&encoding=U&templateid=' . $template_id,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
    ));

    $response = curl_exec($curl);

    IntegrationResponse::create([
      "model"=>"\App\Models\User",
      "record"=>$mobile,
      "response"=>json_encode($response)
    ]);

    curl_close($curl);
  }
}
