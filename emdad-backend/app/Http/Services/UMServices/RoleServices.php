<?php

namespace App\Http\Services\UMServices;

use App\Http\Collections\RolesCollection;
use App\Http\Resources\UMResources\Role\RoleResponse;
use App\Models\UM\Role;


class RoleServices
{

    public function store($request)
    {
        $role = Role::create($request->all());
        if ($role) {
            return response()->json([ "statusCode"=>'000','message' => 'created successfully'], 200);
        }
        return response()->json(["statusCode"=>'999','error' => 'system error'], 500);
    }

    public function update($request,$id)
    {
        $role = Role::where('id',$id)->first();
        if($role==null)
        {
        return response()->json(["statusCode"=>'111','error' => 'No data Founded', 'data'=>[]], 404);

        }else{
            $result = $role->update($request->all());
                return response()->json(["statusCode"=>'000','message' => 'updated successfully'], 200);
        }

    }

    public function index($request)
    {
        // dd('lk');

        return RoleResponse::collection(RolesCollection::collection($request));
    }

    public function show($id)
    {
        $role = Role::where('id', $id)->first();

        return $role;
    }

    public function delete($id)
    {
        $role = Role::find($id);

        $deleted = $role->delete();

        

        if ($deleted) {
            return ["statusCode"=>'000','message' => 'deleted  from  successfully'];

        }
        return ["statusCode"=>'111','message' => 'not found'];

    }

    public function restoreById($id)
    {
        $restore = Role::where('id', $id)->withTrashed()->restore();
        if ($restore) {
            return response()->json(["statusCode"=>'000','message' => 'restored successfully'], 200);
        }
        return response()->json(["statusCode"=>'999','error' => 'system error'], 500);
    }


}
