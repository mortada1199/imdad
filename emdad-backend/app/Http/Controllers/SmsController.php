<?php

namespace App\Http\Controllers;

use App\Http\Requests\General\SendSmsRequest;
use App\Http\Services\General\SmsService;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class SmsController extends Controller
{



    /**
     * @OA\Get(
     * path="/api/v1_0/sendSms",
     * operationId="send-sms",
     * tags={"System api and external integration"},
     * summary="send sms ",
     * description="send sms",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"mobile","msgBody"},
     *               @OA\Property(property="mobile", type="string"),
     *               @OA\Property(property="msgBody", type="string"),
     *            ),
             
     *        ),
        
     *    ),
     *      @OA\Response(
     *          response=200,
     * description="sent successfully"
     *       ),
     
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public static function sendSms(SendSmsRequest $request,SmsService $sms)
    {
        $sms->sendSms( $request->mobile, $request->msgBody);
            
    }
}
