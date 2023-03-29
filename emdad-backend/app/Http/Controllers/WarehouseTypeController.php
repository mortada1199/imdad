<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountRequests\Location\CreateWarehouseTypeRequest;
use App\Http\Requests\AccountRequests\Location\UpdateWarehouseTypeRequest;
use App\Http\Services\AccountServices\WarehouseTypeService;
use Illuminate\Http\Request;

class WarehouseTypeController extends Controller
{
    protected WarehouseTypeService $warehouseTypeService;
    public function __construct(WarehouseTypeService $warehouseTypeService)
    {
        $this->warehouseTypeService = $warehouseTypeService;
    }
    
     /**
     * @OA\get(
     * path="/api/v1_0/warehouses/warehouse-types",
     * operationId="WarehouseTypes",
     * tags={"WarehouseTypeController"},
     * summary="get the warehouse types",
     * description="get the warehouse types Here",
     *     @OA\Parameter(
     *         name="x-authorization",
     *         in="header",
     *         description="Set x-authorization",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *         *     @OA\Parameter(
     *         name="token",
     *         in="header",
     *         description="Set user authentication token",
     *         @OA\Schema(
     *             type="beraer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *        response=200,
     *          description="collection",
     *          @OA\JsonContent(),
     *          @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="message", type="string"),
     *               @OA\Property(property="statusCode", type="string"),
     *               @OA\Property(property="data", type = "object")
     *            ),
     *          ),
     *       ),
     * )
     */
   
    public function index(Request $request){
        return $this->warehouseTypeService->index($request);
    }

     /**
     * @OA\Post(
     * path="/api/v1_0/warehouses/warehouse-types",
     * operationId="create-warehouse-types",
     * tags={"warehouse-types"},
     * summary="create warehouse-types",
     * description="create warehouse-types Here",
     *     @OA\Parameter(
     *         name="x-authorization",
     *         in="header",
     *         description="Set x-authorization",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *         *     @OA\Parameter(
     *         name="token",
     *         in="header",
     *         description="Set user authentication token",
     *         @OA\Schema(
     *             type="beraer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"nameEn","nameAr"},
     *               @OA\Property(property="nameEn", type="string"),
     *               @OA\Property(property="nameAr", type="string"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *        response=200,
     *          description="created Successfully",
     *      *          @OA\JsonContent(),
     *          @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="message", type="string"),
     *               @OA\Property(property="statusCode", type="string"),
     *               @OA\Property(property="data", type = "object")
     *            ),
     *          ),
     *       ),
     *       ),
     * )
     */
    
    public function store(CreateWarehouseTypeRequest $request){
        $output = $this->warehouseTypeService->store($request);

        return response()->json([ 'statusCode'=> $output['statusCode'], "message"=>$output['message'], "success"=> $output['success'], "data"=> $output['data'] ],200);
    }

    /**
     * @OA\put(
     * path="/api/v1_0/warehouses/warehouse-types/{warehouse_type}",
     * operationId="update_warehouse_type",
     * tags={"warehouse_type"},
     * summary="update warehouse type",
     * description="update warehouse type Here",
     *     @OA\Parameter(
     *         name="x-authorization",
     *         in="header",
     *         description="Set x-authorization",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *         *     @OA\Parameter(
     *         name="token",
     *         in="header",
     *         description="Set user authentication token",
     *         @OA\Schema(
     *             type="beraer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="nameEn", type="string"),
     *               @OA\Property(property="nameAr", type="string"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="updated Successfully",
     *      *          @OA\JsonContent(),
     *          @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="message", type="string"),
     *               @OA\Property(property="statusCode", type="string"),
     *               @OA\Property(property="data", type = "object")
     *            ),
     *          ),
     *       ),
     *       ),
     * )
     */
    
    public function update(UpdateWarehouseTypeRequest $request, $id){
        $output = $this->warehouseTypeService->update($request, $id);

        return response()->json([ 'statusCode'=> $output['statusCode'], "message"=>$output['message'], "success"=> $output['success'], "data"=> $output['data'] ],200);
    }

    /**
     * @OA\delete(
     * path="/api/v1_0/warehouses/warehouse-types/{warehouse_type}",
     * operationId="delete_warehouse_type",
     * tags={"warehouse_type"},
     * summary="delete warehouse type",
     * description="delete warehouse type Here",
     *     @OA\Parameter(
     *         name="x-authorization",
     *         in="header",
     *         description="Set x-authorization",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *         *     @OA\Parameter(
     *         name="token",
     *         in="header",
     *         description="Set user authentication token",
     *         @OA\Schema(
     *             type="beraer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"id"},
     *               @OA\Property(property="id", type="integer")
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=301,
     *          description="deleted successfully",
     *      *          @OA\JsonContent(),
     *          @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="message", type="string"),
     *               @OA\Property(property="statusCode", type="string"),
     *               @OA\Property(property="data", type = "object")
     *            ),
     *          ),
     *       ),
     *       ),

     * )
     */
    
    public function destroy($id){
        $output = $this->warehouseTypeService->delete($id);

        return response()->json([ 'statusCode'=> $output['statusCode'], "message"=>$output['message'], "success"=> $output['success']],200);

    }
    
    /**
     * @OA\put(
     * path="/api/v1_0/warehouses/warehouse-types/restore/{warehouse_type}",
     * operationId="restore_warehouse_type",
     * tags={"warehouse_type"},
     * summary="restore By warehouse_type_id",
     * description="restore By warehouse_type_id Here",
     *     @OA\Parameter(
     *         name="x-authorization",
     *         in="header",
     *         description="Set x-authorization",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *         *     @OA\Parameter(
     *         name="token",
     *         in="header",
     *         description="Set user authentication token",
     *         @OA\Schema(
     *             type="beraer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"warehouse_type"},
     *               @OA\Property(property="warehouse_type", type="integer")
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="restored successfully",
     *      *          @OA\JsonContent(),
     *          @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="message", type="string"),
     *               @OA\Property(property="statusCode", type="string"),
     *               @OA\Property(property="data", type = "object")
     *            ),
     *          ),
     *       ),
     *       ),

     * )
     */

    public function restore($id){
        $output = $this->warehouseTypeService->restore($id);

        return response()->json([ 'statusCode'=> $output['statusCode'], "message"=>$output['message'], "success"=> $output['success']],200);

    }
}
