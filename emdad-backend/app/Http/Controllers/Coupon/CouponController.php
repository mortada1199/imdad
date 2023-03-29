<?php

namespace App\Http\Controllers\Coupon;

use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequests\CreateCouponRequest;
use App\Http\Requests\CouponRequests\UsedCouponRequest;
use App\Http\Resources\General\CouponResponse;
use App\Http\Resources\Subscription\SubscriptionResource;
use App\Http\Services\CouponServices\CouponServices;
use Illuminate\Http\Request;


// use Illuminate\Http\Client\Request;

class CouponController extends Controller
{

    protected CouponServices $couponService;

    public function __construct(CouponServices $couponService)
    {
        $this->couponService = $couponService;
    }
    /**
     * @OA\Post(
     * path="/api/v1_0/coupon",
     * operationId="createCoupon",
     * tags={"Coupon"},
     * summary="create Coupon",
     * description="create Coupon Here",
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
     *               required={"allowed","startDate","endDate","value","isPercentage"},
     *               @OA\Property(property="allowed", type="integer"),
     *               @OA\Property(property="startDate", type="date_format:Y/m/d"),
     *               @OA\Property(property="endDate", type="date_format:Y/m/d"),
     *               @OA\Property(property="value", type="integer"),
     *               @OA\Property(property="isPercentage", type="boolean")
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *        response=200,
     *        description="created Successfully"),
     *      @OA\Response(response=500, description="system error"),
     *      @OA\Response(response=422, description="Validate error"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function store(CreateCouponRequest $request)
    {
        $coupon = $this->couponService->create($request);

        if ($coupon) {
            return response()->json([
                "statusCode" => "000",
                'message' => 'created Successfully'
            ], 200);
        }
        return response()->json([
            "statusCode" => "264",
            'success' => false, 'message' => "coupon Dosn't created "
        ], 200);
    }

    /**
     * @OA\get(
     *    path="/api/v1_0/coupon",
     *    operationId="showallcoupons",
     *    tags={"Coupon"},
     *    summary="show all  coupons",
     *    description="show all  coupons Here",
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
     *         @OA\JsonContent(
     *         @OA\Property(property="Maincatogre", type="integer", example="{'id': 1, 'code': 1234567 ,'used': 0, 'allowed': 1, 'startdate': 2022-1-1, 'enddate': 2022-2-1}")
     *          ),
     *       )
     *      )
     *  )
     */

    public function index(Request $request)
    {

        $coupon  =  $this->couponService->showCoupon();
        if ($coupon != null) {
            return  response()->json(["statusCode" => '000', 'data' =>  CouponResponse::collection($coupon)], 200);
        } else {
            return  response()->json(["statusCode" => '999', 'message'=>'No  data  found'], 200);

        }
    }



    /**
     * @OA\post(
     * path="/api/v1_0/coupon/used",
     * operationId="usedcoupon",
     * tags={"Coupon"},
     * summary="used Coupon ",
     * description=" used Coupon Here",
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
     *               required={"code","subscriptionpayment_id"},
     *               @OA\Property(property="code", type="string"),
     *               @OA\Property(property="subscriptionpayment_id", type="integer")
     *            ),
     *        ),
     *    ),
     * @OA\Response(
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

    public function usedCoupon(UsedCouponRequest $request)
    {
        $subscription = $this->couponService->usedCoupon($request);

        if ($subscription != null) {
            return response()->json([
                "statusCode" => "000",
                'data' => new SubscriptionResource($subscription),
                'message' => 'aproved successfully'
            ], 200);
        } else {
            return response()->json([
                "statusCode" => "264",
                'message' => 'can,t use coupon'
            ], 301);
        }
    }


    /**
     * @OA\delete(
     *    path="/api/v1_0/coupon/{id}",
     *    operationId="removecoupons",
     *    tags={"Coupon"},
     *    summary="remove coupons",
     *    description="remove  coupons Here",
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
     *  )
     */
    public function destroy($id)
    {
        $coupon = $this->couponService->destroy($id);

        if ($coupon) {
            return response()->json(['message' => 'deleted successfully', 'statusCode' => 112], 301);
        } else {
            return response()->json(['success' => false, 'error' => 'not found', 'statusCode' => 111], 404);
        }
    }

    /**
     * @OA\put(
     *    path="/api/v1_0/coupon/restore/{id}",
     *    operationId="restorecoupons",
     *    tags={"Coupon"},
     *    summary="restore coupons",
     *    description="restore coupons Here",
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
     *  )
     */
    public function restore($id)
    {
        $restore = $this->couponService->restore($id);

        if ($restore) {
            return response()->json(['message' => 'restored successfully'], 200);
        }
        return response()->json(['error' => 'system error'], 500);
    }

    /**
     * @OA\get(
     *    path="/api/v1_0/measures/get-all-unit-of-measure",
     *    operationId="getallunitofmeasure",
     *    tags={"UOM"},
     *    summary="show all unit of measure",
     *    description="show all unit of measure Here",
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
     *  )
     */
    public function Unit_of_measures(Request $request)
    {
        $unit = $this->couponService->get_all_unit_of_measure();

        return response()->json(['data' => $unit], 200);
    }
}
