<?php

namespace App\Http\Controllers\Profile;

use App\Http\Collections\DriverCollection;
use App\Http\Controllers\Controller;
use App\Http\Requests\Driver\CreateDriverRequest;
use App\Http\Requests\Driver\SuspendRequest;
use App\Http\Resources\Delviery\DriverResources;
use App\Http\Services\AccountServices\DriverService;
use App\Models\Accounts\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return DriverCollection::collection($request);
    }

    /**
     * @OA\Post(
     * path="/api/v1_0/drivers",
     * operationId="createdrivers",
     * tags={"Delivery"},
     * summary="create drivers ",
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
     *               required={"nameAr","nameEn","age","phone","nationality"},
     *               @OA\Property(property="nameAr", type="string"),
     *               @OA\Property(property="nameEn", type="string"),
     *               @OA\Property(property="age", type="integer"),
     *               @OA\Property(property="phone", type="string"),
     *               @OA\Property(property="nationality", type="string"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="driver created Successfully",
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
    public function store(CreateDriverRequest $request, DriverService $driverService)
    {
        $this->authorize('create', Driver::class);
        $drivers = $driverService->store($request);
        if ($drivers != null) {
            return response()->json(['message' => "created Successfly", "data" => new DriverResources($drivers)], 201);
        }
        return response()->json(['error' => "System Error"], 403);
    }

    /**
     * @OA\get(
     * path="/api/v1_0/drivers/{id}'",
     * operationId="getdriversById",
     * tags={"Delivery"},
     * summary="get driver By Id",
     * description="get driver By Id Here",
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
     *          description="get driver By Id",
     *          @OA\JsonContent(),
     *          @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object"
     *            ),
     *        ),
     *
     *       ),
     *      @OA\Response(response=500, description="system error"),
     *      @OA\Response(response=422, description="Validate error"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function show(DriverService $driverService, $id)
    {
        $this->authorize('view', Driver::class);


        $driver = $driverService->show($id);
        if ($driver != null) {
            return response()->json(["data" => new DriverResources($driver)], 201);
        }
        return response()->json(['error' => "System Error"], 403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
    * @OA\put(
    * path="/api/v1_0/drivers",
    * operationId="update-drivers",
    * tags={"Delivery"},
    * summary="update drivers",
    * description="update driver Here",
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
    *               @OA\Property(property="nameAr", type="string"),
    *               @OA\Property(property="nameEn", type="string"),
    *               @OA\Property(property="age", type="integer"),
    *               @OA\Property(property="phone", type="string"),
    *               @OA\Property(property="nationality", type="string"),
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
    public function update(Request $request, $id, DriverService $driverService)
    {
         $this->authorize('update',Driver::class);

        $driver = $driverService->update($request, $id);
        if ($driver) {
            return response()->json(['message' => "updated Successfly", "data" => new DriverResources($driver)], 201);
        }
        return response()->json(['error' => "System Error"], 403);
    }

    /**
    * @OA\post(
    * path="/api/v1_0/drivers/suspend",
    * operationId="suspend-drivers",
    * tags={"Delivery"},
    * summary="suspend/activate drivers",
    * description="suspend or activate driver Here",
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
    *      @OA\Response(response=500, description="system error"),
    *      @OA\Response(response=422, description="Validate error"),
    *      @OA\Response(response=404, description="Resource Not Found"),
    * )
    */

    public function suspend(SuspendRequest $request, $id, DriverService $driverService)
    {

        return $driverService->suspend($request, $id);
    }

    /**
     * @OA\delete(
     * path="/api/v1_0/drivers",
     * operationId="delete-drivers",
     * tags={"Delivery"},
     * summary="Delete drivers",
     * description="delete driver here",
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
     *          description="driver deleted successfully",
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
    public function destroy($id, DriverService $driverService)
    {
        $this->authorize('delete',Driver::class);

        $driver = $driverService->destroy($id);
        if ($driver)
            return response()->json(['message' => "deleted Successfly"], 201);

        return response()->json(['error' => "System Error"], 403);
    }
    /**
     * @OA\put(
     * path="/api/v1_0/drivers/restore/{id}'",
     * operationId="restoredriverkById",
     * tags={"Delivery"},
     * summary="restore driver By Id",
     * description="restore driver By Id Here",
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
     *          description="restore driver By Id",
     *          @OA\JsonContent(),
     *          @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="message", type="string")
     *            ),
     *          ),
     *       ),
     *      @OA\Response(response=500, description="system error"),
     *      @OA\Response(response=422, description="Validate error"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function restore($id, DriverService $driverService)
    {
        $driver = $driverService->restore($id);
        dd($driver);
        if ($driver != null) {
            return response()->json(['message' => "restored Successfly"], 201);

        }
        return response()->json(['error' => "System Error"], 403);
    }

}
