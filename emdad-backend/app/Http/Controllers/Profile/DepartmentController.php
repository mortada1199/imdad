<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Department\DepartmentRequest;
use App\Http\Requests\Department\UpdateDepartmentRequest;
use App\Http\Services\UMServices\DepartmentServices;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public DepartmentServices $departmentService;


    public function __construct(DepartmentServices $departmentService) {
        $this->departmentService = $departmentService;
    }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
    }


     /**
        * @OA\Post(
        * path="/api/v1_0/department",
        * operationId="createdepartment",
        * tags={"Department"},
        * summary="create department ",
        * description="create department  Here",
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
        *               required={"name"},
        *               @OA\Property(property="name", type="string"),
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
    public function store(DepartmentRequest $request)
    {
        return $this->departmentService->createDepartment($request);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

/**
        * @OA\put(
        * path="/api/v1_0/Department",
        * operationId="updateDepartment",
        * tags={"warehouse"},
        * summary="update Department",
        * description="update Department Here",
     *     @OA\Parameter(
     *         name="user_id",
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
        *     @OA\RequestBody(
        *         @OA\JsonContent(),
        *         @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               required={"id"},
        *               @OA\Property(property="name", type="string"),

        *            ),
        *        ),
        *    ),
        *      @OA\Response(
        *        response=200,
        *          description="updated Successfully",
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
    public function update(UpdateDepartmentRequest $request, $id)
    {
        return $this->departmentService->updateDepartment($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
