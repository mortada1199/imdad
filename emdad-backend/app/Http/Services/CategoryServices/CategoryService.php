<?php

namespace App\Http\Services\CategoryServices;

use App\Http\Collections\CategoryCollection;
use App\Http\Resources\CategoryPivotResource;
use App\Http\Resources\CategoryResourses\category\CategoryResource;
use App\Models\Emdad\Category;
use App\Models\Profile;
use App\Models\ProfileCategoryPivot;
use Exception;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\at;

class CategoryService
{



    public function index($request)
    {
        return CategoryResource::collection(CategoryCollection::collection($request));
    }


    public static function store($request)
    {
        return DB::transaction(function () use ($request) {
            $category = Category::create([
                'name_en' => $request->nameEn,
                'name_ar' => $request->nameAr,
                'isleaf' => $request->isleaf ?? 0,
                'parent_id' => $request->parentId ?? 0,
                "reason" => $request->note,
                'type' => $request->type ?? 'products',
                'created_by' => auth()->id()
            ]);
            if ($category) {
                // $category->companyCategory()->attach($category->id, ['category_id' => $category->id, 'profile_id' => auth()->user()->profile_id,'user_id'=>auth()->id()]);
                $category->profiles()->attach($category, ['category_id' => $category->id, 'profile_id' => auth()->user()->profile_id, 'user_id' => auth()->id()]);
            }
            if (auth()->user()->profile_id) {
                $category->update(['profile_id' => auth()->user()->profile_id]);
            }
            return $category;
        });
    }





    public static  function show($id)
    {
        $category = Category::where('id', $id)->first();

        return $category;
        // if ($category) {
        //     return response()->json(['data' => new CategoryResource($category)], 200);
        // }
        // return response()->json(['error' => 'No data Founded'], 404);
    }



    public static function update($request, $id)
    {
        $category = Category::where('id', $id)->first();

        if ($category != null) {
            $category->update([
                'name_en' => $request->nameEn ?? $category->name_en,
                'name_ar' => $request->nameAr ?? $category->name_ar,
                'isleaf' => $request->isleaf ?? $category->isleaf,
                'parent_id' => $request->parentId ?? $category->parent_id,
                "status" => $request->status ?? $category->status,
                "reason" => $request->reason ?? $category->reason,
                'type' => $request->type ?? $category->type,
            ]);
            return $category;
        }
    }

    public  static function destroy($id)
    {
        $category = Category::find($id);
        if ($category != null) {
            $category->delete();
            
        }
        return  $category;
    }


    public static function restore($id)
    {
        $restore = Category::where('id', $id)->where('deleted_at', '!=', null)->withTrashed()->restore();
        return $restore;
    }

    public function setCategories($request)
    {
        $category = Category::first();
        if (isset($request['categoryList'])) {
            foreach ($request['categoryList'] as $category_id) {

                try {
                    $category->companyCategory()->attach($category->id, ['category_id' => $category_id, 'profile_id' => auth()->user()->profile_id, 'user_id' => auth()->user()->id]);
                } catch (Exception $e) {
                }
            }
        } else {
            $category->companyCategory()->attach($category->id, ['category_id' => $request->categoryId, 'profile_id' => auth()->user()->profile_id, 'user_id' => auth()->user()->id]);
        }
        return response()->json(['message' => 'created successfully'], 200);
    }

    public  static function RetryApproval($request)
    {
        $category = Category::where('id', $request->categoryId)->where('profile_id', auth()->user()->profile_id)->first();
        if ($category->status == "rejected") {
            $category->update([
                "status" => "pending",
                "reason" => $request->reason ?? $category->reason,
            ]);

            return $category;
        }
        
    }

    public static function changeCategoryStatus($request)
    {

        $profile = Profile::where('id', auth()->user()->profile_id)->first();
        $category = Category::where('id', $request->categoryId)->first();
             if ($profile != null) {
             $result = $profile->categories()->updateExistingPivot($request->categoryId,['status' => 'inActive']);
              if($result)
              return $category;
        }
    }


    public  function approveCategory($request)
    {
        $category = Category::where('id', $request->categoryId)->first();
        if ($category != null) {
            $category->update(['status' => 'approved']);

            return $category;
        }
    }


    public static function rejectCategory($request)
    {
        $category = Category::where('id', $request->categoryId)->first();
        if ($category != null) {
            $category->update(['status' => 'rejected']);

            return $category;
        }
    }
    public  static function filterCategory($request)
    {
        $category = Category::where('type', $request->type)->get();
        return $category;
    }

    public function getCategoryProfile($request)
    {

        return CategoryResource::collection(CategoryCollection::collection($request));
    }

    public function activation($request , $id){
        $category =Category::find($id);
        if ($category != null) {
            $category->profiles()->updateExistingPivot(auth()->user()->profile_id,[
                "status" => $request->status]);
            }
        return $category;
    }


    // public function setedCategoryProfile()
    // {

    //     if (auth()->user()->profile_id == null) {
    //         return response()->json(["error" => "", "code" => "100", "message" => "category does not have profile"], 200);
    //     } else {
    //         $categories = ProfileCategoryPivot::where("profile_id", auth()->user()->profile_id)->get();
    //         return response()->json(["success" => true, "code" => "200", "data" =>  CategoryPivotResource::collection($categories)], 200);
    //     }

    // }
}
