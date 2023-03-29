<?php

namespace App\Http\Controllers\Accounts;

use App\Models\User;
// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use App\Models\Accounts\SubscriptionPackages;
use App\Http\Resources\General\CreateSubPackageRequest;
use App\Http\Services\AccountServices\SubscriptionService;
use App\Http\Resources\SetupResources\SubscriptionPackageResource;
use App\Http\Requests\AccountRequests\Subscription\UpdateSubscriptionRequest;
use App\Http\Requests\General\CreateSubPackageRequest as GeneralCreateSubPackageRequest;
use App\Http\Resources\Subscription\SubscriptionResource;
use Illuminate\Http\Request;
// use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Support\Facades\DB;

class SubscriptionController extends Controller
{
    protected SubscriptionService $subscriptionService;

    /**
     * Create a new controller instance.
     *
     * @param  App\Http\Services\AccountServices\SubscriptionService  $subscriptionService
     * @return void
     */
    public function __construct(SubscriptionService $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }

    /**
     * @OA\post(
     * path="/api/v1_0/packages",
     * operationId="create-sub-packages",
     * tags={"Platform Settings"},
     * summary="create Subscription packages",
     * description="create Subscription package",
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
     *               required={"packageNameAr","packageNameEn","type","features","features.*.key","price1"},
     *                @OA\Property(property="packageNameAr", type="string"),
     *                @OA\Property(property="packageNameEn", type="string"),
     *                @OA\Property(property="type", type="string"),
     *                @OA\Property(property="price1", type="integer"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *        response=200,
     *          description="created successfully",
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
     */
    public function store(GeneralCreateSubPackageRequest $request)
    {
        $subscription = $this->subscriptionService->store($request);

        if ($subscription) {
            return response()->json(['success' => true, 'data' => $subscription], 200);
        }
        return response()->json(['message' => 'system error'], 500);
    }
    /**
     * @OA\put(
     * path="/api/v1_0/packages",
     * operationId="update-sub-packages",
     * tags={"Platform Settings"},
     * summary="update Subscription packages if update old flag is set true all presubscribed companies subscription details will be overwriteen",
     * description="update Subscription",
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
     *               required={"features.*.key"},
     *                @OA\Property(property="features.*.key", type="string"),
     *          ),
     *        ),
     *    ),
     *      @OA\Response(
     *        response=200,
     *          description="updated successfully",
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
     *       ),
     * )
     */
    public function update(UpdateSubscriptionRequest $request, $id)
    {
        $subscription = $this->subscriptionService->update($request, $id);
        
        if ($subscription) {
            return response()->json(['success' => true, 'data' => new SubscriptionResource($subscription) ], 200);
        }
        return response()->json(['error' => 'system error'], 500);
    }


    /**
     * @OA\Get(
     * path="/api/v1_0/packages/get-buyer-packs",
     * operationId="get-buyer-packages",
     * tags={"Platform Settings"},
     * summary="get package information",
     * description="get buyer package info",
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
     *          description="supplier packages",
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
    public function getBuyerPackages()
    {

        return response()->json(["success" => true, "data" => SubscriptionPackageResource::collection(SubscriptionPackages::where("type", "Buyer")->get())], 200);
    }



    /**
     * @OA\Get(
     * path="/api/v1_0/packages/get-supplier-packs",
     * operationId="get-supplier-packages",
     * tags={"Platform Settings"},
     * summary="get package information",
     * description="get buyer package info",
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
     *          description="supplier packages",
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
    public function getSupplierPackages()
    {
        return response()->json(["success" => true, "data" => SubscriptionPackageResource::collection(SubscriptionPackages::where("type", "Supplier")->get())], 200);
    }
/**
        * @OA\get(
        * path="/api/v1_0/packages/{id}'",
        * operationId="getpackageById",
        * tags={"Platform Settings"},
        * summary="get package By Id",
        * description="get package By Id Here",
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
        *          description="get package By Id",
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
        $subscription = $this->subscriptionService->show($id);

        if ($subscription) {

            return response()->json(['data' => new SubscriptionResource($subscription) ], 200);
        }
        return response()->json(['message' => 'system error'], 500);
    }
/**
        * @OA\delete(
        * path="/api/v1_0/packages/{id}'",
        * operationId="deletepackage",
        * tags={"Platform Settings"},
        * summary="delete package",
        * description="delete package Here",
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
        *        description="delete package",
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
        $subscription = $this->subscriptionService->destroy($id);

        if ($subscription) {
            return response()->json(['message' => 'deleted successfully'], 200);
        }
        return response()->json(['error' => 'system error'], 500);
    }
/**
        * @OA\put(
        * path="/api/v1_0/packages/restore/{id}'",
        * operationId="restorepackageById",
        * tags={"Platform Settings"},
        * summary="restore package By Id",
        * description="restore package By Id Here",
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
        *          description="restore package By Id",
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

    public function restore($id)
    {
        $subscription = $this->subscriptionService->restore($id);

        if ($subscription) {
            return response()->json(['message' => 'restored successfully'], 200);
        }
        return response()->json(['error' => 'system error'], 500);
    }

    /**
     * @OA\get(
     * path="/api/v1_0/installtion/seed",
     * operationId="seederDb",
     * tags={"Platform Settings"},
     * summary="seeder db",
     * description="seeder db Here",
     *      @OA\Response(
     *        response=200,
     *          description="",
     *         @OA\JsonContent(
     *         @OA\Property(property="message", type="string")
     *          )
     *       ),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function seeder()
    {
        Artisan::call('db:seed');
        dd("Seeder Command run succssfly");
    }
    /**
     * @OA\get(
     * path="/api/v1_0/installation/migrate",
     * operationId="migrateDb",
     * tags={"Platform Settings"},
     * summary="migrate db",
     * description="migrate db Here",
     *      @OA\Response(
     *        response=200,
     *          description="",
     *         @OA\JsonContent(
     *         @OA\Property(property="message", type="string")
     *          )
     *       ),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    
    public function migration()
    {
        Artisan::call('migrate');
        dd("Migrate Command run succssfly");
    }

    public function migrateFresh()
    {
        Artisan::call('migrate:fresh');
        dd("Migrate Command run succssfly");
    }

    public function apiKey()
    {
        Artisan::call('apikey:generate app1');
        dd("Api Key Command run succssfly");
    }

    public function key()
    {
        $key = DB::table('api_keys')->select('key')->get();

        dd($key);
    }
}
