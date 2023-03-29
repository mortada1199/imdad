<?php

namespace App\Http\Controllers\User;

use App\Http\Collections\UserCollection;
use App\Http\Controllers\Auth\MailController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UMRequests\DeleteWarehouseRequest;
use App\Http\Requests\UMRequests\UpdateUserWarehouseStatusRequest;
use App\Http\Requests\UMRequests\User\DefaultCompanyRequest;
use App\Http\Requests\UMRequests\User\GetUserRequest;
use App\Http\Requests\UMRequests\User\RestoreUserByIdRequest;
use App\Http\Requests\UMRequests\User\StoreUserRequest;
use App\Http\Requests\UMRequests\User\UpdateRequest;
use App\Http\Requests\UMRequests\User\UploadAvaterRequest;
use App\Http\Requests\UMRequests\User\UserAvtivateRerquest;
use App\Http\Resources\UMResources\User\UserResponse;
use App\Http\Services\UMServices\UserServices;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{


    public function index(Request $request)
    {
        return UserResponse::collection(UserCollection::collection($request));
    }
    /**
     * @OA\get(
     * path="/api/v1_0/users/get-users",
     * operationId="get-users",
     * tags={"UM & Permissions"},
     * summary="get-users ",
     * description="get-users Here",
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
     *          response=200,
     *          description="User created successfully",
     *          @OA\JsonContent(),
     *          @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="message", type="string"),
     *               @OA\Property(property="data", type="object")
     *            ),
     *          ),
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

    public function getProfileUsers(Request $request)
    {
        // return DB::statement("select * from users");
        if (auth()->user()->profile_id == null) {
            return response()->json(["error" => "", "code" => "100", "message" => "user does not have profile"], 200);
        }
        $users =  DB::table('users')->select('*')
            ->join('profile_role_user', 'profile_role_user.user_id', '=', 'users.id')->where('profile_role_user.profile_id', auth()->user()->profile_id)
            ->paginate($request->pageSize ?? 100);



        return response()->json(["success" => true, "statusCode" => "000", "data" => UserResponse::collection($users)], 200);
    }

    /**
     * @OA\Post(
     * path="/api/v1_0/users/register",
     * operationId="add-user",
     * tags={"UM & Permissions"},
     * summary="Register User",
     * description="Register User in a Company with the preference of being assigned to multiple warehouses ",
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
     *               required={"fullName","password","email","mobile"},
     *               @OA\Property(property="fullName", type="string"),
     *               @OA\Property(property="expireDate", type="date"),
     *               @OA\Property(property="password", type="string"),
     *               @OA\Property(property="email", type="email"),
     *               @OA\Property(property="mobile", type="string"),
     *               @OA\Property(property="identityNumber", type="string"),
     *               @OA\Property(property="identityType", type="string"),
     *               @OA\Property(property="isLearning", type="boolean"),
     *               @OA\Property(property="managerUserId", type="integer"),
     *               @OA\Property(property="warehouseId", type="array(integer)"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="User created successfully",
     *          @OA\JsonContent(),
     *          @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="message", type="string"),
     *               @OA\Property(property="data", type="object")
     *            ),
     *          ),
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
    public function store(StoreUserRequest $request, UserServices $userServices)
    {
        $this->authorize('create', User::class);

        $output = $userServices->create($request->validated());
        switch ($output['statusCode']) {
            case '000':
                $userServices->UserOtp($output['data']);

                MailController::sendSignupEmail($output['data']->name, $output['data']->email, ["admin" => auth()->user()->full_name, "password" => $output['data']->password], "en", "password");
    
                return response()->json(['data' => ['user' => new UserResponse($output['data']), 'statusCode' => $output['statusCode'], "message" => $output['message']]], 200);
                break;
            case '999':
                return response()->json(['data' => ['user' => null, 'statusCode' => $output['statusCode'], "message" => $output['message']]], 200);
                break;
            case '360':
                return response()->json(['data' => ['statusCode' => $output['statusCode'], "message" => $output['message'], "success" => $output['success']]], 200);
                break;
            case '364':
                return response()->json(['data' => ['statusCode' => $output['statusCode'], "message" => $output['message'], "success" => $output['success']]], 200);
                break;
        }
    }

    /**
     * @OA\Get(
     * path="/api/v1_0/users/user-data",
     * operationId="get-user-data-by-token",
     * tags={"UM & Permissions"},
     * summary="Get user Info by token ",
     * description="Register User Here",
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
     *               @OA\Property(property="dataset[defalut_company]", type="string"),

     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(),
     *          @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="message", type="string"),
     *               @OA\Property(property="data", type="object")
     *            ),
     *          ),
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
    public function getUserInfoByToken(Request $request)
    {
        return response()->json(["status" => "success", "data" => new UserResponse(auth()->user())], 200);
    }

    /**
     * @OA\put(
     * path="/api/v1_0/users/update-owner-user/{id}",
     * operationId="updateOwner",
     * tags={"UM & Permissions"},
     * summary="update owner user",
     * description="update update owner user Here",
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
     *               @OA\Property(property="fullName", type="string"),
     *               @OA\Property(property="password", type="string"),
     *               @OA\Property(property="identityNumber", type="string"),
     *               @OA\Property(property="email", type="email"),
     *               @OA\Property(property="mobile", type="string"),
     *               @OA\Property(property="roleId", type="integer"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="User updated successfully",
     *          @OA\JsonContent(),
     *          @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="message", type="string"),
     *               @OA\Property(property="data", type = "object")
     *            ),
     *          ),
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



    public function UpdateOwnerUser(UpdateRequest $request, UserServices $userServices, $id)
    {
        $output = $userServices->update($request, $id);

        switch ($output['statusCode']) {
            case '000':
                return response()->json(['data' => ['user' => $output['otp'] ?? new UserResponse($output['data']), 'statusCode' => $output['statusCode'], "message" => $output['message']]], 200);
                break;
            case '999':
                return response()->json(['data' => ['user' => null, 'statusCode' => $output['statusCode'], "message" => $output['message']]], 200);
                break;
            case '110':
                return response()->json(['data' => ['statusCode' => $output['statusCode'], "message" => $output['message'], "success" => $output['success']]], 200);
                break;
        }
    }


    /**
     * @OA\put(
     * path="/api/v1_0/users/update/{id}",
     * operationId="updateUser",
     * tags={"UM & Permissions"},
     * summary="update User",
     * description="update User Here",
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
     *               @OA\Property(property="fullName", type="string"),
     *               @OA\Property(property="password", type="string"),
     *               @OA\Property(property="email", type="email"),
     *               @OA\Property(property="mobile", type="string"),
     *               @OA\Property(property="roleId", type="integer"),
     *               @OA\Property(property="manager_user_Id", type="integer")
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="User updated successfully",
     *          @OA\JsonContent(),
     *          @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="message", type="string"),
     *               @OA\Property(property="data", type = "object")
     *            ),
     *          ),
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
    public function update(UpdateRequest $request, UserServices $userServices, $id)
    {
         $this->authorize('update', User::class);

        $output = $userServices->update($request, $id);

        switch ($output['statusCode']) {
            case '000':
                return response()->json(['data' => ['user' => $output['otp'] ?? new UserResponse($output['data']), 'statusCode' => $output['statusCode'], "message" => $output['message']]], 200);
                break;
            case '999':
                return response()->json(['data' => ['user' => null, 'statusCode' => $output['statusCode'], "message" => $output['message']]], 200);
                break;
            case '110':
                return response()->json(['data' => ['statusCode' => $output['statusCode'], "message" => $output['message'], "success" => $output['success']]], 200);
                break;
        }
    }


    /**
     * @OA\put(
     * path="/api/v1_0/users/restore/{id}",
     * operationId="restoreUser",
     * tags={"UM & Permissions"},
     * summary="Restore User",
     * description="restore user here",
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
     *          description="User restored successfully",
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
    public function restoreUser(RestoreUserByIdRequest  $request, UserServices $userServices)
    {

        $output = $userServices->restoreById($request);

        switch ($output['statusCode']) {
            case '000':
                return response()->json(['data' => ['statusCode' => $output['statusCode'], "message" => $output['message']]], 200);
                break;
            case '999':
                return response()->json(['data' => ['statusCode' => $output['statusCode'], "error" => $output['error']]], 200);
                break;
            case '360':
                return response()->json(['data' => ['statusCode' => $output['statusCode'], "message" => $output['message'], "success" => $output['success']]], 200);
                break;
            case '364':
                return response()->json(['data' => ['statusCode' => $output['statusCode'], "message" => $output['message'], "success" => $output['success']]], 200);
                break;
        }
    }



    /**
     * @OA\delete(
     * path="/api/v1_0/users/destroy/{id}",
     * operationId="deleteUser",
     * tags={"UM & Permissions"},
     * summary="Delete User",
     * description="delete user here",
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
     *            mediaType="application-json",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="id", type="integer"),
     *               @OA\Property(property="param", type="boolean")
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=301,
     *          description="User deleted successfully",
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
    public function delete(GetUserRequest $id, UserServices $userServices)
    {

        $output = $userServices->delete($id);

        switch ($output['statusCode']) {
            case '000':
                return response()->json(['data' => ['statusCode' => $output['statusCode'], "message" => $output['message']]], 200);
                break;
            case '999':
                return response()->json(['data' => ['statusCode' => $output['statusCode'], "error" => $output['error']]], 200);
                break;
        }
    }




    // public function userActivate(UserAvtivateRerquest $request, UserServices $userServices)
    // {
    //     $output = $userServices->userActivate($request);

    //     if ($output['statusCode'] == "000") {
    //         return response()->json(['data' => ['statusCode' => $output['statusCode'], "message" => $output['message']]], 200);
    //     } elseif ($output['statusCode'] == "999" || $output['statusCode'] == "263") {
    //         return response()->json(['data' => ['statusCode' => $output['statusCode'], "error" => $output['error']]], 200);
    //     }
    // }

    /**
     * @OA\Put(
     * path="/api/v1_0/users/change-status",
     * operationId=" disable",
     * tags={"UM & Permissions"},
     * summary="disable user",
     * description="disable a user within a company",
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
     *            mediaType="application-json",
     *            @OA\Schema(
     *               type="object",
     *               required={"userId"},
     *               @OA\Property(property="userId", type="integer"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=201,
     *          description="disabled Successfully ",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="activated Successfully",
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

    public function disable(UserAvtivateRerquest $request, UserServices $userServices)
    {
        $output = $userServices->disable($request);

        return response()->json(['data' => ['statusCode' => $output['statusCode'], "message" => $output['message']]], 200);
    }


    /**
     * @OA\put(
     * path="/api/v1_0/users/setDefaultCompany",
     * operationId="defaultCompany",
     * tags={"UM & Permissions"},
     * summary="set default company",
     * description="set default company Here",
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
     *               required={"id","companyId"},
     *               @OA\Property(property="id", type="integer"),
     *               @OA\Property(property="companyId", type="integer")
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="Default company successfully'",
     *          @OA\JsonContent(),
     *          @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="message", type="string"),
     *               @OA\Property(property="data",type = "object")
     *            ),
     *          ),
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
    public function setDefaultCompany(DefaultCompanyRequest $request, UserServices $userServices)
    {
        $output = $userServices->setDefaultCompany($request);

        return response()->json(['data' => ['user' => new UserResponse($output['data']), 'statusCode' => $output['statusCode'], "message" => $output['message']]], 200);
    }
    /**
     * @OA\delete(
     * path="/api/v1_0/users/detachWarehouse",
     * operationId="detachWarehouse",
     * tags={"UM & Permissions"},
     * summary="detach Warehouse",
     * description="detach Warehouse Here",
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
     *
     *               required={"userId","warehouseId"},
     *               @OA\Property(property="userId", type="integer"),
     *               @OA\Property(property="warehouseId", type="integer")
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="Default company successfully'",
     *          @OA\JsonContent(),
     *          @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="message", type="string"),
     *               @OA\Property(property="data",type = "object")
     *            ),
     *          ),
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

    public function detachWarehouse(DeleteWarehouseRequest $request, UserServices $userServices)
    {
        $output = $userServices->detachWarehouse($request);

        return response()->json(['data' => ['statusCode' => $output['statusCode'], "message" => $output['message']]], 200);
    }

    /**
     * @OA\put(
     * path="/api/v1_0/users/userWarehouseStatus",
     * operationId="userWarehouseStatus",
     * tags={"UM & Permissions"},
     * summary="user Warehouse Status",
     * description="user Warehouse Status Here",
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
     *
     *               required={"userId","warehouseId"},
     *               @OA\Property(property="userId", type="integer"),
     *               @OA\Property(property="warehouseId", type="integer")
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="Default company successfully'",
     *          @OA\JsonContent(),
     *          @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="message", type="string"),
     *               @OA\Property(property="data",type = "object")
     *            ),
     *          ),
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
    public function userWarehouseStatus(UpdateUserWarehouseStatusRequest $request, UserServices $userServices)
    {
        $output = $userServices->userWarehouseStatus($request);

        return response()->json(['data' => ['statusCode' => $output['statusCode'], "message" => $output['message']]], 200);
    }


    /**
     * @OA\Post(
     * path="/api/v1_0/users/upload-avatar",
     * operationId="upload-avatar",
     * tags={"UM & Permissions"},
     * summary="Upload Avater",
     * description="Upload Avater Here",
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
     *               required={"attachementFile"},
     *               @OA\Property(property="attachementFile", type="file"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="Avatar created successfully",
     *          @OA\JsonContent(),
     *          @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="message", type="string"),
     *               @OA\Property(property="data", type="object")
     *            ),
     *          ),
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
    public function upload(UploadAvaterRequest $request, UserServices $userServices)
    {
        $output = $userServices->uploadAvatar($request);

        return response()->json(['data' => ['statusCode' => $output['statusCode'], "message" => $output['message']]], 200);
    }
    /**
     * @OA\put(
     * path="/api/v1_0/users/change-password",
     * operationId="ChangePassword",
     * tags={"UM & Permissions"},
     * summary="change password",
     * description="change password Here",
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
     *               @OA\Property(property="fullName", type="string"),
     *               @OA\Property(property="email", type="email"),
     *               @OA\Property(property="mobile", type="string"),
     *               @OA\Property(property="identityNumber", type="integer"),
     *               @OA\Property(property="expiry_date", type="string"),
     *               @OA\Property(property="lang", type="string"),
     *               @OA\Property(property="password", type="string"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="Password changed successfully",
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
    public function changePassword(Request $request)
    {
        // if(auth()->user()->password)
        $user = User::find(auth()->id());
        $user->update([
            "full_name" => $request->fullName ?? $user->full_name,
            "email" => $request->email ?? $user->email,
            "mobile" => $request->mobile ?? $user->mobile,
            "identity_number" => $request->identityNumber ?? $user->identity_number,
            'expiry_date' => $request['expireDate'] ?? $user->expiry_date,
            'lang' =>  $request['lang'] ?? $user->lang,
            'password' => $request->password,
            "password_changed" => 1,
        ]);

        return response()->json(['statusCode' => "000", "message" => "password changed successfully"], 200);
    }
}
