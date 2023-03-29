<?php

namespace App\Http\Services\AccountServices;

use App\Http\Collections\TruckCollection;
use App\Http\Resources\AccountResourses\warehouses\TruckResponse;
use App\Models\Accounts\Truck;
use Illuminate\Support\Facades\DB;

class TruckService
{
    public static  function store($request)
    {
        return  DB::transaction(function () use ($request) {
            $truck = Truck::create([
                'name' => $request->name,
                'type' => $request->type,
                'class' => $request->class,
                'color' => $request->color,
                'model' => $request->model,
                'size' => $request->size,
                'brand' => $request->brand,
                'created_by' => auth()->id(),
                'status' => $request->status,
                'plate_number' => $request->plateNumber,
                'profile_id'=>auth()->user()->profile_id
            ]);
            if (isset($request['warehouseList'])) {
                foreach ($request['warehouseList'] as $list) {
                    $truck->warehouses()->attach($truck->id, ['warehouse_id' => $list,'profile_id'=>auth()->user()->profile_id]);
                }
            }
            if (isset($request['attachementFile'])) {
                $truck->addMultipleMediaFromRequest(['attachementFile'])
                    ->each(function ($fileAdder) {
                        $fileAdder->toMediaCollection('trucks');
                    });
            }
            return $truck;
        });
    }
    public  static function update($request, $id)
    {
        $truck = Truck::where('id', $id)->first();
        if ($truck != null) {
            $truck->update([
                'name' => $request->name ?? $truck->name,
                "type" => $request->type ?? $truck->type,
                "class" => $request->class ?? $truck->class,
                "color" => $request->color ?? $truck->color,
                "model" => $request->model ?? $truck->model,
                "size" => $request->size ?? $truck->size,
                "brand" => $request->brand ?? $truck->brand,
                'created_by' => auth()->id() ?? $truck->created_by,
                'status' => $request->status ?? $truck->status,
                'plate_number' => $request->plateNumber ?? $truck->plate_number
            ]);
            if (isset($request['warehouseList'])) {
                foreach ($request['warehouseList'] as $list) {
                    $truck->warehouses()->attach($truck->id, ['warehouse_id' => $list]);
                }
            }
            if (isset($request['attachementFile'])) {
                $truck->addMultipleMediaFromRequest(['attachementFile'])
                    ->each(function ($fileAdder) {
                        $fileAdder->toMediaCollection('trucks');
                    });
            }
            return $truck;
        }
    }
    public function suspend($request, $id)
    {
        $truck = Truck::find($id);
        if ($truck) {
            if ($request->status == 'inActive') {
                $truck->update([
                    'status' => $request->status
                ]);
                return response()->json(['statusCode' => 403, 'message' => "Suspended Successfly"], 201);
            } else {
                $truck->update([
                    'status' => $request->status
                ]);
                return response()->json(['message' => "Activated Successfly"], 201);
            }
        }
        return response()->json(['statusCode' => 500, 'error' => "System Error"], 403);
    }
    public function delete($id)
    {
        $truck = Truck::find($id);
        if ($truck != null) {
            $truck->delete();
            return $truck;
        }
    }
    public function restore($id)
    {
        $restore = Truck::where('id', $id)->withTrashed()->restore();
        return $restore;
    }
    public function index($request)
    {
        return  TruckCollection::collection($request);
    }
    public static function show($id)
    {
        $truck = Truck::where('id', $id)->first();
        return $truck;
    }
}
