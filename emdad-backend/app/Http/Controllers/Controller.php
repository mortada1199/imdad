<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


/**
 * @OA\Info(
 *    title="Emdad Platform API",
 *    version="1.0.0",
 * )
 * 
 *  @OA\Examples(
 *        summary="message sent",
 *        example = "messagesent",
 *       value = {
*           "success": true,
*              "message":"sent successfuly" 
*         },
*      )
*
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
