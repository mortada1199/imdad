<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Services\UMServices\AuthenticationServices;
use App\Mail\ForgetPassword;
use App\Mail\SignupEmail;
use App\Mail\UserCreatedEmail;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class MailController extends Controller
{
    public static function sendSignupEmail($name, $email, $var, $lang = 'en',$type="otp")
    {
        if($type=='otp'){
            $data = [
                'name' => $name,
                'otp' => $var,
                'lang' => $lang,
            ];
            Mail::to($email)->queue(new SignupEmail($data));
        }
        if($type=='password'){
            $data = [
                'name' => $name,
                'var' => $var,
                'lang' => $lang,
            ];
            Mail::to($email)->queue(new UserCreatedEmail($data));
        }
      
    }



    public static function forgetPasswordEmail($name, $email, $otp, $lang = "en")
    {
        $token = DB::table('password_resets')->select('token')->where('email', $email)->latest()->first();
        $data = [
            'name' => $name,
            'email' => $email,
            'lang' => $lang,
            'link' => "https://emdad.nctr.sd/reset-password?email=" . $email . "&token=" . $token->token
        ];
        // dd($data);

        Mail::to($email)->queue(new ForgetPassword($data));
    }
}
