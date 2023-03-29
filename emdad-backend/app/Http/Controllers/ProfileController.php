<?php

namespace App\Http\Controllers;

use App\Http\Collections\ProfileCollection;
use App\Http\Requests\AccountRequests\Account\GetByAccountIdRequest;
use App\Http\Requests\AccountRequests\Account\RestoreAccountRequest;
use App\Http\Requests\Profile\StoreProfileRequest;
use App\Http\Requests\Profile\UpdateProfileRequest;
use App\Http\Requests\UMRequests\User\UploadlogoRequest;
use App\Http\Resources\AccountResourses\Profile\ProfileResponse;
use App\Http\Services\AccountServices\AccountService;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    protected AccountService $accountService;

    /**
     * Create a new controller instance.
     *
     * @param  App\Http\Services\AccountServices\AccountService  $accountService
     * @return void
     */
    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }


 /**
     * @OA\get(
     * path="/api/v1_0/profiles",
     * operationId="filtercompanyinfo",
     * tags={"Profile Controller"},
     * summary="filter company info",
     * description="filter company info Here",
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



    public function index(Request $request )
    {
        return  ProfileResponse::collection( ProfileCollection::collection($request));
    }


    /**
     * @OA\Post(
     * path="/api/v1_0/profiles",
     * operationId="createAccount",
     * tags={"Profile Controller"},
     * summary="create Company Account",
     * description="create Company Account Here",
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
     *               required={"crNo","roleId", "PrfoileType"},
     *               @OA\Property(property="roleId", type="integer"),
     *               @OA\Property(property="crNo", type="string"),
     *               @OA\Property(property="ProfileType", type="integer"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *        response=200,
     *          description="created Successfully",
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
    public function store(StoreProfileRequest $request)
    {
        $output = $this->accountService->store($request);

        return response()->json([ 'statusCode'=> $output['statusCode'], "success"=> $output['success'], "data"=> $output['data'] ],200);
    }


    /**
     * @OA\get(
     * path="/api/v1_0/profiles/{id}",
     * operationId="getByAccountId",
     * tags={"Profile Controller"},

     * summary="get By AccountId",
     * description="get By AccountId Here",
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
     *        response=200,
     *          description="",
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
        $output = $this->accountService->show($id);
        if($output['statusCode'] == "000"){
            return response()->json(['statusCode'=> $output['statusCode'], 'data' => $output['data'] ],200);
        }elseif($output['statusCode'] == "111") {
            return response()->json(['statusCode'=> $output['statusCode'], 'error' => $output['error'] ],200);
        }
    }

    /**
     * @OA\put(
     * path="/api/v1_0/updateProfile/{id}",
     * operationId="updateAccount",
     * tags={"Profile Controller"},

     * summary="update Account",
     * description="update Profile using current Profile Id",
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
     *               required={},
     *               @OA\Property(property="logo", type="file"),
     *               @OA\Property(property="nameAr", type="string"),
     *               @OA\Property(property="nameEn", type="string"),
     *               @OA\Property(property="swift", type="string"),
     *               @OA\Property(property="iban", type="string"),
     *               @OA\Property(property="type", type="string"),
     *               @OA\Property(property="bank", type="string"),
     *               @OA\Property(property="subscriptionDetails", type="string"),
     *               @OA\Property(property="vatNumber", type="string"),
     *               @OA\Property(property="active", type="string")
     *             ),
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


    public function update(UpdateProfileRequest $request,$id)
    {
        $output = $this->accountService->update($request,$id);

        return response()->json([ 'data' => ['statusCode'=> $output['statusCode'], "message"=> $output['message'] ]],200);
    }

    /**
     * @OA\delete(
     * path="/api/v1_0/profiles/{id}",
     * operationId="deleteAccount",
     * tags={"Profile Controller"},

     * summary="delete Account",
     * description="delete Account",
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
     *        response=301,
     *          description="deleted successfully",
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
        $output = $this->accountService->delete($id);

        return response()->json([ 'data' => ['statusCode'=> $output['statusCode'], "message"=> $output['message'] ]],200);
    }
    /**
     * @OA\put(
     * path="/api/v1_0/profiles/{id}",
     * operationId="restoreByAccountId",
     * tags={"Profile Controller"},

     * summary="restore By AccountId",
     * description="restore By AccountId",
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
     *        response=200,
     *          description="restored successfully",
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
    public function restoreByAccountId($id)
    {
        $output = $this->accountService->restore($id);

        return response()->json([ 'data' => ['statusCode'=> $output['statusCode'], "message"=> $output['message'] ]],200);
    }

    /**
     * @OA\get(
     * path="/api/v1_0/accounts/getAllUnValidated",
     * operationId="allUnValidatedAccounts",
     * tags={"Profile Controller"},

     * summary="allUnValidatedAccounts",
     * description="allUnValidatedAccounts",
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
     *               required={""},
     *               @OA\Property(property="", type="")
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *        response=200,
     *          description="all companys validated collections ",
     *         @OA\JsonContent(
     *         @OA\Property(property="AllUnVAlidateAccount", type="integer", example="{'id': 2}")
     *          ),
     *       ),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=500, description="system error"),
     * )
     */


    // public function allUnValidatedAccounts()
    // {
    //     return $this->accountService->unValidate();
    // }

    /**
     * @OA\put(
     * path="/api/v1_0/accounts/validate/{id}",
     * operationId="validatedAccount",
     * tags={"Profile Controller"},

     * summary="validatedAccount",
     * description="validatedAccount",
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
     *        response=200,
     *          description="validated successfully ",
     *       ),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=500, description="system error"),
     * )
     */
    // public function validatedAccount(GetByAccountIdRequest $request, $id)
    // {
    //     return $this->accountService->validate($id);
    // }


    public function swap_profile($id)
    {
        $output = $this->accountService->swap_profile($id);

        return response()->json([ 'data' => ['statusCode'=> $output['statusCode'], "message"=> $output['message'], "profileId"=> $output['profile_id'] ]],200);
    }


    
    /**
     * @OA\post(
     * path="/api/v1_0/upload-logo",
     * operationId="uploadlogo",
     * tags={"Profile Controller"},

     * summary="validatedAccount",
     * description="validatedAccount",
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
     *               required={"logo"},
     *               @OA\Property(property="logo", type="")
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *        response=200,
     *          description="validated successfully ",
     *       ),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=500, description="system error"),
     * )
     */
    public function upload(UploadlogoRequest $request,AccountService $AccountServices){
        $output = $AccountServices->uploadlogo($request);

        return response()->json([ 'data' => ['statusCode'=> $output['statusCode'], "message"=> $output['message'] ]],200);
    }



}


