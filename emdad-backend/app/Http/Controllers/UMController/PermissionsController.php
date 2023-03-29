<?php

namespace App\Http\Controllers\UMController;

use App\Http\Controllers\Controller;
use App\Http\Requests\UMRequests\Permission\AddPemissonToRoleRequest;
use App\Http\Requests\UMRequests\Permission\GetPermissionRequest;
use App\Http\Requests\UMRequests\Permission\CreatePermissionRequest;
use App\Http\Requests\UMRequests\Permission\DeletePermissonRequest;
use App\Http\Requests\UMRequests\Permission\UpdatePermissionRequest;
use App\Http\Requests\UMRequests\Permission\RestorePermissionRequest;
use App\Http\Resources\UMResources\Permission\PermissionResponse;
use App\Http\Services\UMServices\PermissionServices;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{

    protected PermissionServices $PermissionService;

    /**
     * Create a new controller instance.
     *
     * @param  App\Http\Services\UMServices\PermissionServices  $PermissionService
     * @return void
     */
    public function __construct(PermissionServices $PermissionService)
    {
        $this->PermissionService = $PermissionService;
    }
       /**
        * @OA\Post(
        * path="/api/v1_0/permissions",
        * operationId="savePermissionToRole",
        * tags={"Roles and Permissions"},
        * summary="save permisssion",
        * description="save permission to role Here",
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
        *               required={"name", "label","category","description"},
        *               @OA\Property(property="name", type="string"),
        *               @OA\Property(property="label", type="string"),
        *               @OA\Property(property="category", type="string"),
        *               @OA\Property(property="description", type="string"),
        *            ),
        *        ),
        *    ),
        *      @OA\Response(
        *          response=200,
        *          description="created or updated permission",
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
    public function store(CreatePermissionRequest $request) {
        $permission = $this->PermissionService->store($request);
        if ($permission != null) {
            return response()->json(["statusCode"=>'000','message' => 'created successfully'], 200);
        }
        return response()->json(["statusCode"=>'999','error' => 'system error'], 500);
    }
       /**
        * @OA\get(
        * path="/api/v1_0/permissions/getAll",
        * operationId="getAllPermissions",
        * tags={"Roles and Permissions"},
        * summary="get permisssions",
        * description="get all permisssions Here",
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
        *          description="get all permissions",
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
    public function index(Request $request) {
        return $this->PermissionService->index($request);
    }
       /**
        * @OA\get(
        * path="/api/v1_0/permissions/getById/{id}",
        * operationId="get-permissions",
        * tags={"Roles and Permissions"},
        * summary="get permisssion",
        * description="get permission by id Here",
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
        *          description="get permission",
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
    public function show($id) {
        $permission = $this->PermissionService->show($id);

        if ($permission != null) {
            return response()->json(['data' => new PermissionResponse($permission)], 200);
        }
        return response()->json(["statusCode" => '999', 'error' => 'No data Found'], 404);
    }
       /**
        * @OA\Put(
        * path="/api/v1_0/permissions",
        * operationId="updatePermissionToSpecificRole",
        * tags={"Roles and Permissions"},
        * summary="update permisssion",
        * description="update permission to specific role Here",
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
        *        @OA\JsonContent(),
        *        @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               required={"id","privileges"},
        *               required={"name", "label","category","description"},
        *               @OA\Property(property="name", type="string"),
        *               @OA\Property(property="label", type="string"),
        *               @OA\Property(property="category", type="string"),
        *               @OA\Property(property="description", type="string"),
        *            ),
        *          ),
        *       ),
        *      @OA\Response(
        *          response=200,
        *          description="update permission",
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
    public function update(UpdatePermissionRequest $request,$id){
        $update = $this->PermissionService->update($request, $id);
        if ($update != null) {
            return response()->json(["statusCode" => '000', 'success' => 'Updated Successfly', 'data' => PermissionResponse::make($update)], 200);
        } else {

            return response()->json(["statusCode" => '999', 'error' => 'No data Found'], 404);
        }
    }
       /**
        * @OA\delete(
        * path="/api/v1_0/permissions/delete/{id}",
        * operationId="delete-permission-from-specific-role",
        * tags={"Roles and Permissions"},
        * summary="update permisssion",
        * description="update permission to specific role Here",
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
        *          description="delete permission",
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
        $permission =  $this->PermissionService->delete($id);
        if ($permission != null) {
            return response()->json(["statusCode" => '000', 'message' => 'deleted successfully'], 301);
        } else {
            return response()->json(["statusCode" => '111', 'success' => false, 'error' => 'not found'], 404);
        }
    }
       /**
        * @OA\delete(
        * path="/api/v1_0/permissions/restore/{id}",
        * operationId="restore-permission-to-specific-role",
        * tags={"Roles and Permissions"},
        * summary="restore permisssion",
        * description="restore permission to specific role Here",
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
        *          description="restore permission",
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
    public function restoreById( $permissionId){
        $permission=  $this->PermissionService->restoreById($permissionId);
        if ($permission) {
            return response()->json(['message' => 'restored successfully'], 200);
        }
        return response()->json(["statusCode"=>'999','error' => 'system error'], 500);
    }
    /**
        * @OA\Post(
        * path="/api/v1_0/permissions/addPermissionToRole",
        * operationId="AddPermissionToPermissions",
        * tags={"Roles and Permissions"},
        * summary="Add new permisssion",
        * description="Add a new permission to the permissions list within a role",
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
        *               required={"userId","roleId","label"},
        *               @OA\Property(property="userId", type="string"),
        *               @OA\Property(property="roleId", type="string"),
        *               @OA\Property(property="label", type="string"),
        *            ),
        *        ),
        *    ),
        *      @OA\Response(
        *          response=200,
        *          description="created  new permission",
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

    public function PermissionToRole(AddPemissonToRoleRequest $request){
        $permission= $this->PermissionService->addPermisson($request);
        if($permission){
        return response()->json(["statusCode"=>'000','data'=>$permission,'success' => 'Permission added successfully'], 200);
        }
        return response()->json(["statusCode"=>'362','error' => 'permission already exist'], 500);

    }
/**
        * @OA\delete(
        * path="/api/v1_0/permissions/RemovePermission",
        * operationId="DeletePermissionFromPermissions",
        * tags={"Roles and Permissions"},
        * summary="Delete permisssion from list",
        * description="Delete a permission label from the permissions list within a role",
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
        *               required={"userId","roleId","label"},
        *               @OA\Property(property="userId", type="string"),
        *               @OA\Property(property="roleId", type="string"),
        *               @OA\Property(property="label", type="string"),
        *            ),
        *        ),
        *    ),
        *      @OA\Response(
        *          response=200,
        *          description="Permission Deleted",
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
    public function DeletePermissionOnRole(DeletePermissonRequest $request){
        $permission =  $this->PermissionService->removePermission($request);
        if($permission){
            return response()->json(["statusCode"=>'000','data'=>$permission,'message' => 'permission Deleted Successfully'], 200);
        }
        return response()->json(["statusCode"=>'111','data'=>$permission,'error' => 'Record not Found'], 200);   

    }
}
