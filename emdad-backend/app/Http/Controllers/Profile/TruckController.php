<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountRequests\Truck\CreateTruckRequest;
use App\Http\Requests\AccountRequests\Truck\UpdateTruckRequest;
use App\Http\Requests\Driver\SuspendRequest;
use App\Http\Resources\AccountResourses\warehouses\TruckResponse;
use App\Http\Services\AccountServices\TruckService;
use App\Models\Accounts\Truck;
use Illuminate\Http\Request;

class TruckController extends Controller
{
    protected TruckService $truckservice;


    public function __construct(TruckService $truckservice)
    {

        $this->truckservice = $truckservice;
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\get(
     * path="/api/v1_0/trucks",
     * operationId="gettrucks",
     * tags={"trucks"},
     * summary="get trucks",
     * description="get all trucks Here",
     *     @OA\Parameter(
     *         name="x-authorization",
     *         in="header",
     *         description="Set x-authorization",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="get all trucks",
     *          @OA\JsonContent(),
     *          @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *            ),
     *        ),
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *          @OA\JsonContent(),
     *          @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="message", type="sstring"),
     *               @OA\Property(property="statusCode", type="string"),
     *               @OA\Property(property="data", type = "object")
     *            ),
     *          ),
     *       ),
     * )
     */

    public function index(Request $request)
    {
        return $this->truckservice->index($request);
    }

    /**
     * @OA\Post(
     * path="/api/v1_0/trucks",
     * operationId="createtrucks",
     * tags={"trucks"},
     * summary="create trucks ",
     * description="create trucks  Here",
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
     *               required={"name","type","class","color","model","size","brand","image"},
     *               @OA\Property(property="name", type="string"),
     *               @OA\Property(property="type", type="string"),
     *               @OA\Property(property="class", type="string"),
     *               @OA\Property(property="color", type="string"),
     *               @OA\Property(property="model", type="string"),
     *               @OA\Property(property="size", type="string"),
     *               @OA\Property(property="brand", type="string"),
     *               @OA\Property(property="image", type="file")
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="department created Successfully",
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
    public function store(CreateTruckRequest $request)
    {
        $this->authorize('create', Truck::class);
        $truck = $this->truckservice->store($request); 
        if ($truck !=null) {
            return  response()->json(['statusCode' => 000, 'message' => 'created successfully', 'data' => new TruckResponse($truck)], 201);
        } else {
            return  response()->json(['statusCode' => 400, 'message' => 'Not created '], 111);
        }
    }

        /**
     * @OA\get(
     * path="/api/v1_0/trucks/{id}'",
     * operationId="gettrucksById",
     * tags={"trucks"},
     * summary="get trucks By Id",
     * description="get trucks By Id Here",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
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
     *      @OA\Response(
     *        response=200,
     *          description="get trucks By Id",
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
    public function show($id)
    { 
        $truck = $this->truckservice->show($id);
        if ($truck != null) {
            return response()->json(['data' => new TruckResponse($truck)], 200);
        }
        return response()->json(["statusCode" => '999', 'error' => 'No data Found'], 404);
    }

    /**
     * @OA\put(
     * path="/api/v1_0/trucks/{id}",
     * operationId="update-trucks",
     * tags={"trucks"},
     * summary="update trucks",
     * description="update Depatrucksrtment Here",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
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

     *      @OA\Response(
     *        response=200,
     *          description="updated Successfully",
     *          @OA\JsonContent(),
     *          @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="name", type="string"),
     *               @OA\Property(property="type", type="string"),
     *               @OA\Property(property="class", type="string"),
     *               @OA\Property(property="color", type="string"),
     *               @OA\Property(property="model", type="string"),
     *               @OA\Property(property="size", type="string"),
     *               @OA\Property(property="brand", type="string"),
     *               @OA\Property(property="image", type="file"),
     *               @OA\Property(property="message", type="string")
     *            ),
     *        ),
     *
     *       ),
     *      @OA\Response(response=500, description="system error"),
     *      @OA\Response(response=422, description="Validate error"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */

    public function update(UpdateTruckRequest $request, $id)
    {
        $this->authorize('update', Truck::class);

        $truck =  $this->truckservice->update($request, $id);
        if ($truck != null) {
            return response()->json(['statusCode' => 401, 'success' => 'Updated Successfly', 'data' => new TruckResponse($truck)], 201);
        } else {
            return response()->json(['statusCode' => 402, 'error' => 'canot Updated truck'], 201);
        }
    }

    /**
     * @OA\put(
     * path="/api/v1_0/trucks/suspend/{id}",
     * operationId="suspend-trucks",
     * tags={"trucks"},
     * summary="suspend/activate trucks",
     * description="suspend or activate trucks Here",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
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

     *      @OA\Response(
     *        response=200,
     *          description="updated Successfully",
     *          @OA\JsonContent(),
     *          @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="status", type="string"),
     *            ),
     *        ),
     *
     *       ),

     * )
     */

    public function suspend(SuspendRequest $request, $id)
    {

        return $this->truckservice->suspend($request, $id);
    }

    /**
     * @OA\delete(
     * path="/api/v1_0/trucks/{id}",
     * operationId="delete-trucks",
     * tags={"trucks"},
     * summary="Delete trucks",
     * description="delete trucks here",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
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
     *      @OA\Response(
     *          response=301,
     *          description="truck deleted successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function destroy($id)
    {
        $this->authorize('delete', Truck::class);
        $truck =  $this->truckservice->delete($id);
        if ($truck) {
            return response()->json(['statusCode' => 112, 'message' => 'deleted successfully'], 301);
        } else {
            return response()->json(['statusCode' => 111, 'error' => 'not found'], 404);
        }
    }

    /**
     * @OA\put(
     * path="/api/v1_0/trucks/restore/{id}",
     * operationId="restoretruckById",
     * tags={"trucks"},
     * summary="restore truck By Id",
     * description="restore truck By Id Here",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
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
     *      @OA\Response(
     *        response=200,
     *          description="restore warehouse By Id",
     *          @OA\JsonContent(),
     *          @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="message", type="string")
     *            ),
     *          ),
     *       ),
     * )
     */

    public function restoretruck($id)
    {
        $restore =  $this->truckservice->restore($id);

        if ($restore) {
            return response()->json(['statusCode' => 113, 'message' => 'restored successfully'], 200);
        }
        return response()->json(['statusCode' => 500, 'error' => 'system error'], 500);
    }
}
