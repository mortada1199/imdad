<?php

namespace App\Http\Controllers\emdad;

use App\Http\Controllers\Controller;
use App\Http\Requests\General\GetRelatedCompanyRequest;
use App\Http\Resources\General\RelatedCompaiesResource;
use App\Http\Services\General\WathiqService;
use App\Models\Emdad\RelatedCompanies;
use Illuminate\Http\Request;

class WathiqController extends Controller
{
  /**
        * @OA\Get(
        * path="/api/v1_0/wathiq/relatedCr",
        * operationId="wathiq-integration",
        * tags={"Platform Settings"},
        * summary="Retreive registered companies by user identity + identity type nid/iqama",
        * description="users' registerd companies",
*     @OA\Parameter(
     *         name="x-authorization",
     *         in="header",
     *         description="Set x-authorization",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
        *     @OA\RequestBody(
        *         @OA\JsonContent(),
        *         @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               required={"identityNumber","type"},
        *               @OA\Property(property="identityNumber", type="string"),
        *               @OA\Property(property="type", type="integer"),
    
        *            ),
        *        ),
        *    ),
        *      @OA\Response(
        *        response=200,
     *          description="Companies list",
        *             @OA\JsonContent(),
     *          @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="success", type="boolean"),
     *               @OA\Property(property="data", type="string"),
     *        ),
        *
        *       ),
        *       ),
        *      @OA\Response(response=500, description="system error"),
        *      @OA\Response(response=422, description="Validate error"),
        *      @OA\Response(response=404, description="Resource Not Found"),
        * )
        */

    public function getRelatedCompanies(GetRelatedCompanyRequest $request, WathiqService $service)
    {
        $related = RelatedCompanies::where("identity", $request->identityNumber)->where("identity_type", $request->type)->get();

        if (sizeOf($related) > 0) {
            return response()->json(["status" => true, "data" => RelatedCompaiesResource::collection($related)], 200);
        } else {
            $service->getRelatedCompanies($request->identityNumber, $request->type);
            

            $related = RelatedCompanies::where("identity", $request->identityNumber)->where("identity_type", $request->type)->get();
            return response()->json(["status" => true, "data" => RelatedCompaiesResource::collection($related)], 200);
        }
    }

    public function getLookupLocations(){
        $locations = WathiqService::getLocations();
        return $locations;
    }

    public function getBusinessTypes(){
        $types = WathiqService::getBusinessTypes();
        return $types;
    }

    public function getRelations(){
        $relations = WathiqService::getRelations();
        return $relations;
    }

    public function getNationalities(){
        $nationalities = WathiqService::getNationalities();
        return $nationalities;
    }

    public function getActivities(){
        $nationalities = WathiqService::getActivities();
        return $nationalities;
    }



    public function fullInfo($id){
        $Fullinfo = WathiqService::getFullInfo($id);
        return $Fullinfo;
    }
    public function Info($id){
        $info = WathiqService::getInfo($id);
        return $info;
    }  
    public function Status($id){
        $Status = WathiqService::getStatus($id);
        return $Status;
    }

    public function Managers($id){
        $Managers = WathiqService::getManagers($id);
        return $Managers;
    }
    public function Owners($id){
        $Owners = WathiqService::getOwners($id);
        return $Owners;
    }
    public function owns($id,$idType){
        $owns = WathiqService::getOwns($id,$idType);
        return $owns;
    }

    

}
