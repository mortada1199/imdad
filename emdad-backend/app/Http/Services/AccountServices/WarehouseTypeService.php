<?php

namespace App\Http\Services\AccountServices;

use App\Http\Collections\WarehouseCollection;
use App\Http\Collections\WarehouseTypeCollection;
use App\Http\Resources\AccountResourses\warehouses\WarehouseResponse;
use App\Http\Resources\AccountResourses\warehouses\WarehouseTypeResponse;
use App\Models\Accounts\Warehouse;
use App\Models\User;
use App\Models\UserWarehousePivot;
use App\Models\WarehouseType;
use Exception;
use Illuminate\Support\Facades\DB;

class WarehouseTypeService
{
    public function index($request){
        return WarehouseTypeResponse::collection(WarehouseTypeCollection::collection($request));
    }

    public static function store($request){
        $warehouse_type = WarehouseType::create([
            'name_en' => $request->nameEn,
            'name_ar' => $request->nameAr,
        ]);

        $output = ["statusCode" => "000", 'success' => true, "message"=>"Tyoe Created successfully", 'data' => $warehouse_type];
        return $output;
    }

    public static function update($request, $id){
        $warehouse_type = WarehouseType::find($id);
        if ($warehouse_type != null) {
            $warehouse_type->update([
                'name_en' => $request->nameEn ?? $warehouse_type->name_en,
                'name_ar' => $request->nameAr ?? $warehouse_type->name_ar,
            ]);
        } else {
            $warehouse_type = null;
            $output = ["statusCode" => "999", 'success' => false, "message" => "system error", 'data' => $warehouse_type];
            return $output;
        }
        $output = ["statusCode" => "000", 'success' => true, "message" => "Type Updated successfully", 'data' => $warehouse_type];
        return $output;
    }

    public static function delete($id){
        $warehouse_type = WarehouseType::find($id)->delete();

        if($warehouse_type){
            $output = ["statusCode" => "000", 'success' => true, "message" => "Type deleted successfully"];
            return $output;
        }else{
            $output = ["statusCode" => "999", 'success' => false, "message" => "system errors"];
            return $output;
        }
    }

    public static function restore($id){
        $warehouse_type = WarehouseType::withTrashed()->findorfail($id)->restore();

        if($warehouse_type){
            $output = ["statusCode" => "000", 'success' => true, "message" => "Type Restored Successfully"];
            return $output;
        }else{
            $output = ["statusCode" => "999", 'success' => false, "message" => "System Error"];
            return $output;
        }
    }

  
}