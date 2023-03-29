<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscriptionPaymentRequest;
use App\Http\Services\SubscriptionPaymentService;
use Illuminate\Http\Request;

class SubscriptionPaymentController extends Controller
{
    protected SubscriptionPaymentService $subscriptionPaymentService;

    public function __construct(SubscriptionPaymentService $subscriptionPaymentService)
    {
        $this->subscriptionPaymentService = $subscriptionPaymentService;
    }

        /**
     * @OA\post(
     *    path="/api/v1_0/profiles/subscriptionPayment",
     *    operationId="create-subscriptionPayment",
     *    tags={"Profile Controller"},
     *    summary="create subscriptionPayment",
     *    description="create subscriptionPayment",
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
     *  *     @OA\RequestBody(
        *         @OA\JsonContent(),
        *         @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               required={"packageId","type"},
        *               @OA\Property(property="packageId", type="integer"),
        *            ),
        *        ),
        *    ),
     *    @OA\Response(
     *         response=200,
     *         description="",
     *         @OA\JsonContent(
     *         @OA\Property(property="packageId", type="integer", example="{' 'id': 1, 'compnay_id': '1','subscription_id': 1, 'user_id': 1, 'sub_total': 13.0, 'days': 30,'tax_amount':15,'total':28.0}")
     *          ),
     *       )
     *      )
     *  )
     */
    public function store(SubscriptionPaymentRequest $request)
    {
        return $this->subscriptionPaymentService->store($request);
    }



  /**
     * @OA\get(
     *    path="/api/v1_0/checkSubscriptionPayment",
     *    operationId="check-subscriptionPayment",
     *    tags={"Profile Controller"},
     *    summary="check subscriptionPayment status",
     *    description="check subscriptionPayment status",
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
     *  *     @OA\RequestBody(
        *         @OA\JsonContent(),
        *         @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *            ),
        *        ),
        *    ),
     *    @OA\Response(
     *         response=200,
     *         description="",
     *         @OA\JsonContent(
     *         @OA\Property(property="status", type="string", example="{'status':'status'}")
     *          ),
     *       )
     *      )
     *  )
     */
    public function check_subscription_payment()
    {
        return $this->subscriptionPaymentService->check_subscription_payment();
    }






/**
     * @OA\delete(
     *    path="/api/v1_0/profiles/subscriptionPayment",
     *    operationId="delete-subscriptionPayment",
     *    tags={"Profile Controller"},
     *    summary="delete subscriptionPayment",
     *    description="delete subscriptionPayment",
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
     *  *     @OA\RequestBody(
        *         @OA\JsonContent(),
        *         @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *            ),
        *        ),
        *    ),
     *    @OA\Response(
     *         response=200,
     *         description="",
     *         @OA\JsonContent(
     *         @OA\Property(property="status", type="string", example="{'status':'status'}")
     *          ),
     *       )
     *      )
     *  )
     */
    public function  destroy($id)
    {
        return $this->subscriptionPaymentService->delete($id);
    }


    

/**
     * @OA\get(
     *    path="/api/v1_0/profiles/pay",
     *    operationId="pay-subscriptionPayment",
     *    tags={"Profile Controller"},
     *    summary="pay subscriptionPayment",
     *    description="You must have a Subscription to a package so you can pay",
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
     *  *     @OA\RequestBody(
        *         @OA\JsonContent(),
        *         @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *            ),
        *        ),
        *    ),
     *    @OA\Response(
     *         response=200,
     *         description="",
     *         @OA\JsonContent(
     *         @OA\Property(property="status", type="string", example="{'status':'status'}")
     *          ),
     *       )
     *      )
     *  )
     */
    public function  pay()
    {
        return $this->subscriptionPaymentService->pay();
    }

/**
     * @OA\get(
     *    path="/api/v1_0/profiles/checkPayment",
     *    operationId="check-PaymentStatus",
     *    tags={"Profile Controller"},
     *    summary="Check Subscription Payment",
     *    description="In order to check the payment you must intially have a subscription and have paid for that subscription",
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
     *  *     @OA\RequestBody(
        *         @OA\JsonContent(),
        *         @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *
        *            ),
        *        ),
        *    ),
     *    @OA\Response(
     *         response=200,
     *         description="",
     *         @OA\JsonContent(
     *         @OA\Property(property="status", type="string", example="{'status':'status'}")
     *          ),
     *       )
     *      )
     *  )
     */

    public function  checkPaymentStatus()
    {
        return $this->subscriptionPaymentService->checkPaymentStatus();
    }

}
