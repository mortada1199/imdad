<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\AddNationalityRequest;
use App\Http\Services\Settings\DriverNationalityService;
use Illuminate\Http\Request;

class DriverNationalityController extends Controller
{
    public DriverNationalityService $driverNationalityServices;


    public function __construct(DriverNationalityService $driverNationalityServices) {
        $this->driverNationalityServices = $driverNationalityServices;
    }

    /**
     * @OA\post(
     *    path="/api/v1_0/nationality",
     *    operationId="storenationality",
     *    tags={"EmdadSettings"},
     *    summary="store nationality",
     *    description="store nationality Here",
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
     *         @OA\Property(property="message",  example="{statusCode => 000 ,message => created successfully  }200")
     *          ),
     *       )
     *      )
     *  )
     */
    public function store(AddNationalityRequest $request)
    {
        $nationality = $this->driverNationalityServices->store($request);
        if($nationality){
            return response()->json(["statusCode" => "000",'message' => 'created successfully', ], 200);
        }
        return response()->json([ "statusCode" => "264",'success' => false, 'message' => "Brand Canot create "], 200);
    }
    

    /**
     * @OA\get(
     *    path="/api/v1_0/nationality",
     *    operationId="shownationality",
     *    tags={"EmdadSettings"},
     *    summary="show nationality",
     *    description="show nationality Here",
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
     *         @OA\Property(property="message",  example="{statusCode => 000 ,data =>  data  }200")
     *          ),
     *       )
     *      )
     *  )
     */
    public function index(Request $request)
    {
        $nationality = $this->driverNationalityServices->show($request);
        if($nationality){
            return response()->json(["statusCode" => "000",'data' => $nationality,
            ], 200);
        }
        return response()->json([
            "statusCode" => "264",'success' => false, 'message' => "Brand Canot create "], 200);
    }




}
