<?php

namespace App\Http\Controllers\Translatoin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Translation\DeleteTranslateRequest;
use App\Http\Requests\Translation\ShowTranslateRequest;
use App\Http\Requests\Translation\TranslateRequest;
use App\Http\Requests\Translation\UpdateTranslateRequest;
use App\Http\Services\Translation\TranslationService;
use Illuminate\Http\Request;

class TranslationController extends Controller
{

    protected TranslationService $TranslationService ;

    public function __construct( TranslationService $TranslationService )
 {

        $this->TranslationService = $TranslationService;
    }

/**
        * @OA\Post(
        * path="/api/v1_0/translation/create",
        * operationId="translation create",
        * tags={"Translation"},
        * summary="translation create",
        * description="translation create Here",
        *     @OA\RequestBody(
        *         @OA\JsonContent(),
        *         @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               required={"key","en_value","ar_value"},
        *               @OA\Property(property="key", type="string"),
        *               @OA\Property(property="en_value", type="string"),
        *               @OA\Property(property="ar_value", type="string")
        *            ),
        *        ),
        *    ),
        *      @OA\Response(
        *        response=200,
        *          description="created Successfully"
        *       ),
        *      @OA\Response(response=404, description="Resource Not Found"),
         *      @OA\Response(response=500, description="system error")
        * )
        */
    public function Create( TranslateRequest $request )
    {
           return $this->TranslationService->Create( $request );
       }


/**
        * @OA\put(
        * path="/api/v1_0/translation/update",
        * operationId="translation update",
        * tags={"Translation"},
        * summary="translation update",
        * description="translation update Here",
        *     @OA\RequestBody(
        *         @OA\JsonContent(),
        *         @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               required={"key"},
        *               @OA\Property(property="key", type="string")
        *            ),
        *        ),
        *    ),
        *      @OA\Response(
        *        response=200,
        *          description="update Successfully"
        *       ),
        *      @OA\Response(response=404, description="Resource Not Found"),
         *      @OA\Response(response=500, description="system error")
        * )
        */
public function Update(UpdateTranslateRequest $request )
{
    return $this->TranslationService->Update( $request );
}

/**
        * @OA\delete(
        * path="/api/v1_0/translation/delete",
        * operationId="translation delete",
        * tags={"Translation"},
        * summary="translation delete",
        * description="translation delete Here",
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
        *          description="update Successfully"
        *       ),
        *      @OA\Response(response=404, description="Resource Not Found"),
         *      @OA\Response(response=500, description="system error")
        * )
        */
public function Delete(DeleteTranslateRequest $request )
{
    return $this->TranslationService->Delete( $request );
}

/**
        * @OA\get(
        * path="/api/v1_0/translation/show",
        * operationId="translation show",
        * tags={"Translation"},
        * summary="translation show",
        * description="translation show Here",
        *     @OA\RequestBody(
        *         @OA\JsonContent(),
        *         @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               required={"key"},
        *               @OA\Property(property="key", type="string")
        *            ),
        *        ),
        *    ),
        *      @OA\Response(
        *        response=200,
        *          description="data"
        *       ),
        *      @OA\Response(response=404, description="Resource Not Found"),
         *      @OA\Response(response=500, description="system error")
        * )
        */
public function Show(ShowTranslateRequest $request )
{
    return $this->TranslationService->Show( $request );
}




}
