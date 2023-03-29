<?php

namespace App\Http\Controllers\UMController;

use App\Http\Resources\UMResources\Role\RoleResponse;

use App\Http\Controllers\Controller;
use App\Http\Services\UMServices\RoleServices;
use App\Http\Requests\UMRequests\Role\GetRoleRequest;
use App\Http\Requests\UMRequests\Role\CreateRoleRequest;
use App\Http\Requests\UMRequests\Role\GetRoleByIdRequest;
use App\Http\Requests\UMRequests\Role\RestoreRoleByIdRequest;
use App\Models\UM\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected RoleServices $roleServices;

    /**
     * Create a new controller instance.
     *
     * @param  App\Http\Services\UMServices\RoleServices  $roleServices
     * @return void
     */
    public function __construct(RoleServices $roleServices)
    {
        $this->roleServices = $roleServices;
    }

    /**
     * @OA\get(
     * path="/api/v1_0/roles",
     * operationId="getAllRoles",
     * tags={"Roles and Permissions"},
     * summary="get roles",
     * description="get all roles Here",
     *     @OA\Parameter(
     *         name="x-authorization",
     *         in="header",
     *         description="Set x-authorization",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="token",
     *         in="header",
     *         description="Set user authentication token",
     *         @OA\Schema(
     *             type="beraer"
     *         )
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="get all roles",
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
    public function index(Request $request)
    {

        return $this->roleServices->index($request);
    }

    /**
     * @OA\post(
     * path="/api/v1_0/roles",
     * operationId="saveNewRole",
     * tags={"Roles and Permissions"},
     * summary="create role",
     * description="create new role Here",
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
     *               required={"name", "type"},
     *               @OA\Property(property="name", type="string"),
     *               @OA\Property(property="type",  type = "string")
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="created role successfully",
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
    public function store(CreateRoleRequest $request)
    {
        $role =  $this->roleServices->store($request);
        if ($role) {
            return response()->json(["statusCode" => '000', 'message' => 'created successfully'], 200);
        }
        return response()->json(["statusCode" => '999', 'error' => 'system error'], 500);
    }
    /**
     * @OA\put(
     * path="/api/v1_0/roles/{id}",
     * operationId="updateRole",
     * tags={"Roles and Permissions"},
     * summary="update role",
     * description="update role Here",
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
     *               @OA\Property(property="name", type="string"),
     *               @OA\Property(property="type",  type = "integer")
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="updated role successfully",
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
    public function update(GetRoleRequest $request, $id)
    {
        $role =  $this->roleServices->update($request, $id);
        if ($role) {
            return response()->json(["statusCode" => '000', 'message' => 'updated successfully'], 200);
        }
        return response()->json(["statusCode" => '111', 'error' => 'No data Founded', 'data' => []], 404);
    }
    /**
     * @OA\delete(
     * path="/api/v1_0/roles/{id}",
     * operationId="deleteRole",
     * tags={"Roles and Permissions"},
     * summary="delete roles",
     * description="delete roles Here",
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
     *          response=200,
     *          description="deleted role successfully",
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
    public function destroy($id)
    {
        $output =  $this->roleServices->delete($id);
        switch ($output['statusCode']) {
            case '000':
                return response()->json(["statusCode" => '000', 'message' => 'deleted successfully'], 200);
                # code...
                break;
            case '111':
                return response()->json(["statusCode" => '111', 'message' => 'not found'], 200);


            default:
                # code...
                break;
        }
    }

    /**
     * @OA\get(
     * path="/api/v1_0/roles/{id}",
     * operationId="getRole",
     * tags={"Roles and Permissions"},
     * summary="get role by id",
     * description="get role Here",
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
     *          response=200,
     *          description="get role",
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
        $role = $this->roleServices->show($id);
        if ($role) {
            return response()->json(['data' => new RoleResponse($role)], 200);
        }
    }
    /**
     * @OA\get(
     * path="/api/v1_0/roles/roles-for-reg",
     * operationId="getRoleRegister",
     * tags={"Roles and Permissions"},
     * summary="get roles register",
     * description="get roles register Here",
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
     *    @OA\Response(
     *         response=200,
     *         description="",
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
    public function getRolesForReg(Request $request)
    {
        return response()->json(["success" => true, "data" => RoleResponse::collection(Role::where("for_reg", 1)->get())], 200);
    }
    /**
     * @OA\put(
     * path="/api/v1_0/roles/restore/{roleId}",
     * operationId="restoreRole",
     * tags={"Roles and Permissions"},
     * summary="restore role by id",
     * description="restore role Here",
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
     *          response=200,
     *          description="restore role successfully",
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
    public function restoreByRoleId($id)
    {
        $role =  $this->roleServices->restoreById($id);
        if ($role) {
            return response()->json(["statusCode" => '000', 'message' => 'restored successfully'], 200);
        }
        return response()->json(["statusCode" => '999', 'error' => 'system error'], 500);
    }
}
