<?php

namespace App\Http\Controllers\emdad;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategroyRequests\Product\CompanyProductRequest;
use App\Http\Requests\CategroyRequests\Product\CreateProuductRequest;
use App\Http\Requests\CategroyRequests\Product\StatusCompanyProductRequest;
use App\Http\Requests\CategroyRequests\Product\UpdateProuductRequest;
use App\Http\Resources\CategoryResourses\Product\ProductResponse;
use App\Http\Services\CategoryServices\ProductService;
// use App\Models\Emdad\Categories;
use App\Models\Emdad\Product;

class ProductController extends Controller
{
    protected ProductService $productService;

    /**
     * Create a new controller instance.
     *
     * @param  App\Http\Services\CategoryServices\ProductService  $productService
     * @return void
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    /**
     * @OA\Post(
     * path="/api/v1_0/products",
     * operationId="createProduct",
     * tags={"Product"},
     * summary="create Product",
     * description="create Product Here",
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
     *               required={"categoryId","nameEn","nameAr","measruingUnit","descriptionEn","descriptionAr"},
     *               @OA\Property(property="categoryId", type="integer"),
     *               @OA\Property(property="nameEn", type="string"),
     *               @OA\Property(property="nameAr", type="string"),
     *               @OA\Property(property="attachementFile", type="file"),
     *               @OA\Property(property="measruingUnit", type="string"),
     *               @OA\Property(property="descriptionEn", type="string"),
     *               @OA\Property(property="descriptionAr", type="string"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *        response=200,
     *          description="created Successfully",
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
     * )
     */
    public function store(CreateProuductRequest $request)
    {
        $this->authorize('create', Product::class);
        $product =  $this->productService->store($request);
        if ($product != null) {
            return response()->json(["statusCode" => "000", 'message' => 'created successfully', "data"  => new ProductResponse($product)], 200);
        }
        return response()->json(["statusCode" => '999',  'error' => 'unkown error'], 500);
    }

    /**
     * @OA\put(
     * path="/api/v1_0/products/{id}",
     * operationId="updateProduct",
     * tags={"Product"},
     * summary="update Product",
     * description="update Product Here",
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
     *               @OA\Property(property="categoryId", type="integer"),
     *               @OA\Property(property="nameEn", type="string"),
     *               @OA\Property(property="nameAr", type="string"),
     *               @OA\Property(property="price", type="integer"),
     *               @OA\Property(property="attachementFile", type="file"),
     *               @OA\Property(property="measruingUnit", type="string"),
     *               @OA\Property(property="descriptionEn", type="string"),
     *               @OA\Property(property="descriptionAr", type="string"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="updated Successfully",
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
     * )
     */

    public function update(UpdateProuductRequest $request, $id)
    {
        $product =  $this->productService->update($request, $id);

        if ($product != null) {
            return response()->json(["statusCode" => '111', 'message' => 'updated successfully', 'data' => new ProductResponse($product)], 200);
        }
        return response()->json(["statusCode" => '999', 'error' => 'unkown error'], 500);
    }



    /**
     * @OA\get(
     * path="/api/v1_0/products",
     * operationId="getAllProducts",
     * tags={"Product"},
     * summary="get All Products",
     * description="get All Products Here",
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
     *      *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={},
     *               @OA\Property(property="perPage", type="integer"),
     *            ),
     *        ),
     *    ),
     *    @OA\Response(
     *         response=200,
     *         description="",
     *               *          @OA\JsonContent(),
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
        return $this->productService->index($request);
    }


    /**
     * @OA\get(
     * path="/api/v1_0/products/{id}",
     * operationId="getByProductId",
     * tags={"Product"},
     * summary="get By ProductId",
     * description="get By ProductId Here",
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
     *          response=200,
     *          description="",
     *         @OA\JsonContent(
     *         @OA\Property(property="ProductById", type="integer", example="{'id': 2, 'name': 'LG','salary': 10000, 'parent_id': 1,'company_id': 1}")
     *          ),

     *       ),

     * )
     */
    public function show($id)
    {
        $this->authorize('view', Product::class);

        $product =  $this->productService->show($id);


        if ($product) {
            return response()->json(["statusCode" => '000', 'data' => new ProductResponse($product)], 200);
        }
        return response()->json(["statusCode" => '111', 'error' => 'Record Not Founded'], 404);
    }

    /**
     * @OA\delete(
     * path="/api/v1_0/products/{id}",
     * operationId="deleteProduct",
     * tags={"Product"},
     * summary="delete Product",
     * description="delete Product Here",
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
     *          response=301,
     *          description="deleted successfully",
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

     * )
     */

    public function destroy($id)
    {
        $deleted = $this->productService->delete($id);
        if ($deleted) {
            return response()->json(["statusCode" => '000', 'message' => 'Deleted Successfully'], 301);
        }
        return response()->json(["statusCode" => '111', 'error' => 'Record Not Found'], 500);
    }

    /**
     * @OA\put(
     * path="/api/v1_0/products/restore/{id}",
     * operationId="restoreByProductId",
     * tags={"Product"},
     * summary="restore By ProductId",
     * description="restore By ProductId Here",
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
     *          response=200,
     *          description="restored successfully",
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

     * )
     */

    public function restore($id)
    {
        $restore =  $this->productService->restore($id);

        if ($restore) {
            return response()->json(["statusCode" => '000', 'message' => 'restored successfully'], 200);
        }
        return response()->json(["statusCode" => '111', 'error' => 'Record Not Found'], 500);
    }






    /**
     * @OA\post(
     * path="/api/v1_0/products/company-products",
     * operationId="companyproduct",
     * tags={"Product"},
     * summary="set company product",
     * description="Set Product or products list to a company profile",
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
     *               required={"productList"},
     *               @OA\Property(property="productList", type="integer"),
     *               @OA\Property(property="productId", type="integer")
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="restored successfully",
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

     * )
     */
    public function setCompanyProduct(CompanyProductRequest $request)
    {
        $product =  $this->productService->setcompanyproducts($request);
        if ($product) {
            return response()->json(["statusCode" => '000', 'message' => 'created successfully'], 200);
        }
    }


    /**
     * @OA\post(
     * path="/api/v1_0/products/change-Product-Status",
     * operationId="changeProductStatus",
     * tags={"Product"},
     * summary="set change Product Status",
     * description="set change Product Status Here",
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
     *               required={"product_id"},
     *               @OA\Property(property="product_id", type="integer")
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
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
    public function changeProductStatus(StatusCompanyProductRequest $request)
    {
        $product = $this->productService->changeProductStatus($request);

        if ($product != null) {
            return response()->json(['message' => 'change product status successfully'], 200);

        } else {
            return response()->json(['error' => 'No products founded' ]);
        }
    }
}
