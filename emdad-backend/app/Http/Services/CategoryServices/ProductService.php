<?php

namespace App\Http\Services\CategoryServices;

use App\Http\Collections\ProductsCollection;
use App\Http\Resources\CategoryResourses\Product\ProductResponse;
use App\Http\Services\AccountServices\UploadServices;
use App\Models\Emdad\Product;
use App\Models\Emdad\ProductAttachmentFile;
use App\Models\Profile;
use App\Models\ProfileCategoryPivot;
use App\Models\ProfileProductsPivot;
use Exception;
use Illuminate\Support\Facades\DB;

class ProductService
{

    public function index($request)
    {
        return ProductResponse::collection(ProductsCollection::collection($request));
    }


    public static function store($request)
    {

       return DB::transaction(function () use ($request) {
            $product = Product::create([
                'category_id' => $request->categoryId,
                'name_en' => $request->nameEn,
                'name_ar' => $request->nameAr,
                'price' => $request->price??null,
                'measruing_unit' => $request->measruingUnit,
                'description_en' => $request->descriptionEn,
                'description_ar' => $request->descriptionAr,
                'created_by' => auth()->id(),
                'profile_id' => auth()->user()->profile_id,
            ]);

            if(isset($request['attachementFile']))
            {
                $product->addMultipleMediaFromRequest(['attachementFile'])
                ->each(function ($fileAdder) {
                    $fileAdder->toMediaCollection('products');
                });
            }
            $product->companyProduct()->attach($product->id, ['profile_id' => auth()->user()->profile_id]);
            return $product;
        });
       
    }


    public static  function update($request, $id)
    {

        $product = Product::find($id);

        // attach the  product to the  meida collection  and update  product 

        if (isset($request['attachementFile'])) {
            $product->addMultipleMediaFromRequest(['attachementFile'])
                ->each(function ($fileAdder) {
                    $fileAdder->toMediaCollection('products');
                });
        }

        $product->update([
            'category_id' => $request->categoryId ?? $product->category_id,
            'name_ar' => $request->nameAr ?? $product->name_ar,
            'name_en' => $request->nameEn ?? $product->name_en,
            "price" => $request->price ?? $product->price,
            "measruing_unit" => $request->measruing_unit ?? $product->measruing_unit,
            'description_en' => $request->descriptionEn ?? $product->description_en,
            'description_ar' => $request->descriptionAr ?? $product->description_ar
        ]);

        return $product;
    }

    public static function show($id)
    {
        $product = Product::where('id', $id)->first();
        return $product;
    }


    public  static function delete($id)
    {
        $product = Product::find($id);
        $deleted = $product->delete();
        return $deleted;
    }

    public  static function restore($id)
    {
        $restore = Product::where('id', $id)->withTrashed()->restore();

        return $restore;
    }



    public static function setcompanyproducts($request)
    {
        $profile = Profile::find(auth()->user()->profile_id);
        if (isset($request['productList'])) {
            foreach ($request['productList'] as $product_id) {
                $profile->products()->attach($product_id,['profile_id' => auth()->user()->profile_id,'created_at'=>now()]);
            }
        } else {
                $profile->products()->attach($request['productId'],[ 'profile_id' => auth()->user()->profile_id,'created_at'=>now()]);
        }
        return true;
    }


    public  static function changeProductStatus($request)
    {



        $profile = Profile::where('id', auth()->user()->profile_id)->first();
        Product::where('id', $request->productId)->first();
             if ($profile != null) {
             $result = $profile->products()->updateExistingPivot($request->productId,['status' => 0]);
            return $result;
        }
    }
}
