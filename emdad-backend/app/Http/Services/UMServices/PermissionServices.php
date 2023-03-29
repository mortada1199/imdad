<?php

namespace App\Http\Services\UMServices;

use App\Http\Collections\PermissionsCollection;
use App\Http\Resources\UMResources\Permission\PermissionResponse;
use App\Http\Resources\UMResources\User\UserResponse;
use App\Models\Profile;
use App\Models\UM\Permission;
use App\Models\UM\RolePermission;
use App\Models\UM\Role;
use App\Models\UM\RoleUserProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermissionServices
{

    public function index($request)
    {
        // return PermissionsCollection::collection($request);
        return Permission::all([ 'name', 'label','category','description'])->groupBy('category');
    }

    public function store($request)
    {
        $Permission = Permission::create($request->all());

        if ($Permission) {
            return response()->json(["statusCode"=>'000','message' => 'created successfully'], 200);
        }
        return response()->json(["statusCode"=>'999','error' => 'system error'], 500);
    }


    public function show($id)
    {

        $Permissions = Permission::where('id', $id)->first();
        if ($Permissions) {
            return response()->json(["statusCode"=>'000','data' => new PermissionResponse($Permissions), 'message' => 'success'], 200);
        }
        return response()->json(["statusCode"=>'111','message' => 'permissions not found ', 'data' => []], 404);
    }



    public function update($request, $id)
    {

        $Permission = Permission::where('id', $id)->first();
        // dd($Permission);
        $Permission = $Permission->update($request->all());

        if ($Permission) {
            return response()->json(["statusCode"=>'000','message' => 'updated successfully'], 200);
        }
        return response()->json(["statusCode"=>'111','error' => 'system error'], 500);
    }




    public function delete($id)
    {
        $Permissions = Permission::find($id)->first();

        $deleted = $Permissions->delete();
        if ($deleted) {
            return response()->json(["statusCode"=>'000','message' => 'deleted successfully'], 301);
        }
        return response()->json(["statusCode"=>'111','error' => 'system error'], 500);
    }

    public function restoreById($permissionId)
    {
        $restore = Permission::where('id', $permissionId)->withTrashed()->restore();
        if ($restore) {
            return response()->json(['message' => 'restored successfully'], 200);
        }
        return response()->json(["statusCode"=>'999','error' => 'system error'], 500);
    }
    public function addPermisson($request)
    {
        $permissions = RoleUserProfile::where('role_id',$request->roleId)->where('user_id',$request->userId )->where('profile_id',auth()->user()->profile_id)->first();

        if($permissions){
            $labels = json_decode($permissions->permissions);
            // dd($labels);
            // dd($json);
            foreach($labels as $label){
                if($label==$request->label){
                    return response()->json(["statusCode"=>'362','error' => 'permission already exist'], 500);
                }
                
            }
            array_push($labels ,$request->label);
        
                $permissions->update(["permissions"=>$labels]);
                return response()->json(["statusCode"=>'000','data'=>$permissions,'success' => 'Permission added successfully'], 200);
        }
    }
    public function removePermission($request)
    {
        $permissions = RoleUserProfile::where('role_id',$request->roleId)->where('user_id',$request->userId )->where('profile_id',auth()->user()->profile_id)->first();
        if($permissions){
            $labels =(array) json_decode($permissions->permissions,true);
            $index=0;
            foreach($labels as $label){
                if($label==$request->label){
                     
                    array_splice($labels,$index,1);
                        $permissions->update(["permissions"=>$labels]);
                    return response()->json(["statusCode"=>'000','data'=>$permissions,'message' => 'permission Deleted Successfully'], 200);
                }

                $index++;
                
            }

             return response()->json(["statusCode"=>'111','data'=>$permissions,'error' => 'Record not Found'], 200);   
            }
           
    }
}
