<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\AddColorRequest;
use App\Http\Services\Settings\ColorService;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public ColorService $colorServices;


    public function __construct(ColorService $colorServices) {
        $this->colorServices = $colorServices;
    }

/**
     * @OA\post(
     *    path="/api/v1_0/colors",
     *    operationId="storecolors",
     *    tags={"EmdadSettings"},
     *    summary="store colors",
     *    description="store colors Here",
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
     *         @OA\Property(property="message",  example="{statusCode => 000 ,message => create successfully }200")
     *          ),
     *       )
     *      )
     *  )
     */
    public function store(AddColorRequest $request)
    {
        $color = $this->colorServices->store($request);
        if($color){
            return response()->json(["statusCode" => "000",'message' => 'created successfully', ], 200);
        }
        return response()->json([ "statusCode" => "264",'success' => false, 'message' => "Color Canot create "], 200);
    }
    
/**
     * @OA\get(
     *    path="/api/v1_0/colors",
     *    operationId="showcolors",
     *    tags={"EmdadSettings"},
     *    summary="show colors",
     *    description="show colors Here",
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
     *         @OA\Property(property="message",  example="{statusCode => 000 ,data => data }200")
     *          ),
     *       )
     *      )
     *  )
     */
    public function index(Request $request)
    {
        $color = $this->colorServices->show($request);
        if($color){
            return response()->json(["statusCode" => "000",'data' => $color,
            ], 200);
        }
        return response()->json([
            "statusCode" => "264",'success' => false, 'message' => "Color Canot create  "], 200);
    }
}
