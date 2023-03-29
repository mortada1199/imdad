<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\AddBrandRequest;
use App\Http\Services\Settings\BrandService;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public BrandService $prandServices;


    public function __construct(BrandService $prandServices) {
        $this->prandServices = $prandServices;
    }

 /**
     * @OA\post(
     *    path="/api/v1_0/brands",
     *    operationId="storebrands",
     *    tags={"EmdadSettings"},
     *    summary="store brands",
     *    description="store brands Here",
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
    public function store(AddBrandRequest $request)
    {
        $brand = $this->prandServices->store($request);
        if($brand){
            return response()->json(["statusCode" => "000",'message' => 'created successfully', ], 200);
        }
        return response()->json([ "statusCode" => "264",'success' => false, 'message' => "Brand Canot create "], 200);
    }
    
 /**
     * @OA\get(
     *    path="/api/v1_0/brands",
     *    operationId="showallbrands",
     *    tags={"EmdadSettings"},
     *    summary="show all brands",
     *    description="show all brands Here",
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
     *         @OA\Property(property="message",  example="{statusCode => 000,data => $brand}200")
     *          ),
     *       )
     *      )
     *  )
     */

    public function index(Request $request)
    {
        $brand = $this->prandServices->show($request);
        if($brand){
            return response()->json(["statusCode" => "000",'data' => $brand,
            ], 200);
        }
        return response()->json([
            "statusCode" => "264",'success' => false, 'message' => "Brand Canot create "], 200);
    }




}
