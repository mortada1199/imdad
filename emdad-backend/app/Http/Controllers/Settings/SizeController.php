<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\AddSizeRequest;
use App\Http\Services\Settings\SizeService;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public SizeService $sizeServices;


    public function __construct(SizeService $sizeServices) {
        $this->sizeServices = $sizeServices;
    }


/**
     * @OA\post(
     *    path="/api/v1_0/sizes",
     *    operationId="store sizes",
     *    tags={"EmdadSettings"},
     *    summary="store sizes",
     *    description="store sizes Here",
     *     @OA\Parameter(
     *         name="x-authorization",
     *         in="header",
     *         description="Set x-authorization",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *        @OA\Parameter(
     *         name="token",
     *         in="header",
     *         description="Set user authentication token",
     *         @OA\Schema(
     *             type="beraer"
     *         )
     *     ),
     *    @OA\Response(
     *         response=200,
     *         description="",
     *         @OA\JsonContent(
     *         @OA\Property(property="message",  example="{statusCode => 000 ,message =>  create successfully  }200")
     *          ),
     *       )
     *      )
     *  )
     */
    public function store(AddSizeRequest $request)
    {
        $size = $this->sizeServices->store($request);
        if($size){
            return response()->json(["statusCode" => "000",'message' => 'created successfully', ], 200);
        }
        return response()->json([ "statusCode" => "264",'success' => false, 'message' => "Size Canot create"], 200);
    }
    
/**
     * @OA\get(
     *    path="/api/v1_0/sizes",
     *    operationId="show sizes",
     *    tags={"EmdadSettings"},
     *    summary="show sizes",
     *    description="show sizes Here",
     *     @OA\Parameter(
     *         name="x-authorization",
     *         in="header",
     *         description="Set x-authorization",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *        @OA\Parameter(
     *         name="token",
     *         in="header",
     *         description="Set user authentication token",
     *         @OA\Schema(
     *             type="beraer"
     *         )
     *     ),
     *    @OA\Response(
     *         response=200,
     *         description="",
     *         @OA\JsonContent(
     *         @OA\Property(property="message",  example="{statusCode => 000 ,data =>   data  }200")
     *          ),
     *       )
     *      )
     *  )
     */
    public function index(Request $request)
    {
        $size = $this->sizeServices->show($request);
        if($size){
            return response()->json(["statusCode" => "000",'data' => $size,
            ], 200);
        }
        return response()->json([
            "statusCode" => "264",'success' => false, 'message' => "Size Canot create "], 200);
    }

}
