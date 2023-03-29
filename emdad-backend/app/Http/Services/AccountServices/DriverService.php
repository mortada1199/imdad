<?php

namespace App\Http\Services\AccountServices;

use App\Http\Resources\Delviery\DriverResources;
use App\Models\Accounts\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DriverService
{

    public function index(Request $request)
    {
        $drivers = Driver::all();
        if ($drivers) {
            return response()->json(['data' => DriverResources::collection($drivers)], 201);
        }
        return response()->json(['message' => "No data founded"], 404);
    }

    public function store($request)
    {
        return  DB::transaction(function () use ($request) {
            $drivers = Driver::create([
                'name_ar' => $request->nameAr,
                'name_en' => $request->nameEn,
                'age' => $request->age,
                'phone' => $request->phone,
                'nationality' => $request->nationality,
                'status' => $request->status,
                'user_id' => $request->user_id,
                'profile_id' => auth()->user()->profile_id,
            ]);
            if (isset($request['warehouseList'])) {
                foreach ($request['warehouseList'] as $list) {
                    $drivers->warehouses()->attach($drivers->id, ['warehouse_id' => $list,'profile_id'=>auth()->user()->profile_id]);
                }
            }
            return $drivers;
        });
    }

    public function show($id)
    {
        $driver = Driver::find($id);
        return $driver;
    }

    public function update($request, $id)
    {
        $driver = Driver::find($id);
        if ($driver) {
            $driver->update([
                'name_ar' => $request->nameAr??$driver->name_ar,
                'name_en' => $request->nameEn??$driver->name_en,
                'age' => $request->age??$driver->age,
                'phone' => $request->phone??$driver->phone,
                'nationality' => $request->nationality??$driver->nationality,
                'status' => $request->status??$driver->status,
                'user_id' => $request->user_id??$driver->user_id,
                'profile_id' => auth()->user()->profile_id??$driver->profile_id,
            ]);
            if (isset($request['warehouseList'])) {
                foreach ($request['warehouseList'] as $list) {
                    $driver->warehouses()->attach($driver->id, ['warehouse_id' => $list, 'profile_id' => auth()->user()->profile_id]);
                }
            }
            return $driver;
        }
    }
    public function destroy($id)
    {
        $driver = Driver::find($id);
        if ($driver) {
            $driver->delete();
        }
        return $driver;
    }

    public function suspend($request, $id)
    {
        $driver = Driver::find($id);

        if ($driver) {
            if ($request->status == 'inActive'){
                $driver->update([
                    'status' => $request->status
                ]);
                return response()->json(['message' => "Suspended Successfly"], 201);
            }else{
                $driver->update([
                    'status' => $request->status
                ]);
                return response()->json(['message' => "Activated Successfly"], 201);
            }
        }
        return response()->json(['error' => "System Error"], 403);
    }

    public function restore($id)
    {
        $driver = Driver::where('id', $id)->withTrashed()->restore();
        if ($driver) {
            return $driver;
        }
    }
}
