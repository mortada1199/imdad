<?php

namespace App\Http\Services\UMServices;

use App\Http\Resources\UMResources\Department\DepartmentResponse;
use App\Models\Department;

class DepartmentServices
{

    public function createDepartment($request)
    {
        $department=Department::create([
            "name"=>$request->name,
             "profile_id"=>auth()->user()->profile_id
        ]);
        return response()->json(["success"=>true,"data"=>new DepartmentResponse($department)],201);
    }

    public function AddDepartment($request)
    {
        $db=Department::create($request);

        //use the same approch for other service (Murtuada)

        $db->users()->attach($db->id,['user_id'=>2,'company_info_id'=>3]);



        return response()->json( [ 'message'=>'department created successfully' ], 200 );
    }

    public function updateDepartment($request,$id){
        $department=Department::where('id',$id)->first();
        $department->update($request->all());
        if ($department) {
            return response()->json([
                'message' => 'department updated successfully',
                'data' => ['department' => new DepartmentResponse($department)]
            ], 200);
        }
        return response()->json(['error' => 'system error'], 500);
    }
}
