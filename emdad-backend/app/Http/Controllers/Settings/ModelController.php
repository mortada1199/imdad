<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\AddModelRequest;
use App\Http\Services\Settings\ModelService;
use Illuminate\Http\Request;

class ModelController extends Controller
{
    public ModelService $modelServices;


    public function __construct(ModelService $modelServices) {
        $this->modelServices = $modelServices;
    }

/**
     * @OA\post(
     *    path="/api/v1_0/models",
     *    operationId="store models",
     *    tags={"EmdadSettings"},
     *    summary="store models",
     *    description="store models Here",
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
    public function store(AddModelRequest $request)
    {
        $model = $this->modelServices->store($request);
        if($model){
            return response()->json(["statusCode" => "000",'message' => 'created successfully', ], 200);
        }
        return response()->json([ "statusCode" => "264",'success' => false, 'message' => "Model Canot create "], 200);
    }
    
/**
     * @OA\get(
     *    path="/api/v1_0/models",
     *    operationId="show models",
     *    tags={"EmdadSettings"},
     *    summary="show models",
     *    description="show models Here",
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
        $model = $this->modelServices->show($request);
        if($model){
            return response()->json(["statusCode" => "000",'data' => $model,
            ], 200);
        }
        return response()->json([
            "statusCode" => "264",'success' => false, 'message' => "Model Canot create "], 200);
    }
}
