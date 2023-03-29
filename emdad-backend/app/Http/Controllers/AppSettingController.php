<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppSetting;
use App\Http\Resources\General\AppSettingsResource;
use App\Http\Services\General\AppSettingsService;
use App\Models\AppSetting;
use App\Models\Settings\Setting;

class AppSettingController extends Controller
{
    /**
     * @OA\get(
     * path="/api/v1_0/installation",
     * operationId="getAppSettings",
     * tags={"Platform Settings"},
     * summary="AppSettings",
     * description="Get All App Settings",
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
    
    public function index()
    {
        $AppSetting = AppSetting::get();
        return response()->json(['success' => true, 'data' => AppSettingsResource::collection($AppSetting), 'statusCode' => '000'], 200);
    }

        /**
     * @OA\post(
     * path="/api/v1_0/installation",
     * operationId="storeAppSettings",
     * tags={"Platform Settings"},
     * summary="AppSettings",
     * description="Store App Settings",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"key", "value"},
     *               @OA\Property(property="Key", type="string"),
     *               @OA\Property(property="value", type="string")
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
    public function store(StoreAppSetting $request, AppSettingsService $appSettings)

    {
        $output = $appSettings->store($request->all());
        return response()->json(['success' => true, 'data' =>new AppSettingsResource($output), 'statusCode' => '000', 'message' => 'settings created successfluy'], 200);
    }
}
