<?php

namespace App\Http\Services\General;

use App\Models\BusinessType;
use App\Models\Emdad\RelatedCompanies;
use App\Models\FullInfo;
use App\Models\LookupActivities;
use App\Models\LookupLocation;
use App\Models\LookupNationality;
use App\Models\LookupRelation;
use App\Models\WathiqInfo;
use App\Models\WathiqManagers;
use App\Models\WathiqOwn;
use App\Models\WathiqOwner;
use App\Models\WathiqStatus;
use Nette\Utils\Json;

use function PHPUnit\Framework\isEmpty;

class WathiqService
{
    // public function __construct (){
    //     $this->
    // }
    public function getRelatedCompanies($id, $idType)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => config('services.wathiq.url_commercial').'/'.'related/' . $id . '/' . $idType,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'apiKey: ' .config('services.wathiq.apiKey').'',
            ),
        ));

        

        $response = curl_exec($curl);
        curl_close($curl);
        if (is_array(json_decode($response))) {
            foreach (json_decode($response) as $relatedCompany) {
                $related = new RelatedCompanies();
                $related->cr_name = $relatedCompany->crName;
                $related->cr_number = $relatedCompany->crNumber;
                $related->business_type = $relatedCompany->businessType->name;
                $related->relation = $relatedCompany->relation->name;
                $related->identity = $id;
                $related->identity_type = $idType;
                $related->save();
            }
        }
    }

    public static function getLocations()
    {
        // dd(config('services.wathiq.url').'/'.'locations');
        // dd(config('services.wathiq.url'.'/'.'locations'));
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => config('services.wathiq.url').'/'.'locations',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'apiKey: ' .config('services.wathiq.apiKey').'',
            ),
        ));

        

        $response = curl_exec($curl);
        curl_close($curl);

        if (is_array(json_decode($response))) {
            foreach (json_decode($response) as $location) {
                $lookup_location = new LookupLocation();
                $lookup_location->loc_number = $location->id;
                $lookup_location->name_ar = $location->name;
                $lookup_location->name_en = $location->nameEn;
                $lookup_location->save();
            }
        }
        return $response;
    }


    public static function getBusinessTypes()
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => config('services.wathiq.url').'/'.'businessTypes',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'apiKey: ' .config('services.wathiq.apiKey').'',
            ),
        ));

        

        $response = curl_exec($curl);
        curl_close($curl);

        if (is_array(json_decode($response))) {
            foreach (json_decode($response) as $type) {
                $business_type = new BusinessType();
                $business_type->type_id = $type->id;
                $business_type->name_ar = $type->name;
                $business_type->name_en = $type->nameEn;
                $business_type->save();
            }
        }
        return $response;
    }


    public static function getRelations()
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => config('services.wathiq.url').'/'.'relations',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'apiKey: ' .config('services.wathiq.apiKey').'',
            ),
        ));

        

        $response = curl_exec($curl);
        curl_close($curl);

        if (is_array(json_decode($response))) {
            foreach (json_decode($response) as $relation) {
                $lookup_relation = new LookupRelation();
                $lookup_relation->relation_id = $relation->id;
                $lookup_relation->name_ar = $relation->name;
                $lookup_relation->name_en = $relation->nameEn;
                $lookup_relation->save();
            }
        }
        return $response;
    }

    public static function getNationalities()
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => config('services.wathiq.url').'/'.'nationalities',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'apiKey: ' .config('services.wathiq.apiKey').'',
            ),
        ));

        

        $response = curl_exec($curl);
        curl_close($curl);

        if (is_array(json_decode($response))) {
            foreach (json_decode($response) as $nationality) {
                $lookup_nationality = new LookupNationality();
                $lookup_nationality->country_id = $nationality->id;
                $lookup_nationality->country_ar = $nationality->country;
                $lookup_nationality->country_en = $nationality->countryEn;
                $lookup_nationality->isoAlpha2 = $nationality->isoAlpha2;
                $lookup_nationality->isoAlpha3 = $nationality->isoAlpha3;
                $lookup_nationality->save();
            }
        }
        return $response;
    }

    public static function getActivities()
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => config('services.wathiq.url').'/'.'activities',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'apiKey: ' .config('services.wathiq.apiKey').'',
            ),
        ));

        

        $response = curl_exec($curl);
        curl_close($curl);

        if (is_array(json_decode($response))) {
            foreach (json_decode($response) as $activity) {
                $lookup_activity = new LookupActivities();
                $lookup_activity->activity_id = $activity->id;
                $lookup_activity->name_ar = $activity->name;
                $lookup_activity->name_en = $activity->nameEn;
                $lookup_activity->level = $activity->level;
                $lookup_activity->category = json_encode($activity->category);
                $lookup_activity->save();
            }
        }
        return $response;
    }


    public static function getFullInfo($id){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => config('services.wathiq.url_commercial').'/'.'fullinfo/'.$id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'apiKey: ' .config('services.wathiq.apiKey').'',
            ),
        ));

        

        $response = curl_exec($curl);
        curl_close($curl);

        if (json_decode($response)) {
            $full_info = new FullInfo();
            $full_info->cr_number = $id;
            $full_info->properties = json_encode($response);
            $full_info->save();
        }
        return $response;
    }

    public static function getInfo($id){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => config('services.wathiq.url_commercial').'/'.'info/'.$id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'apiKey: ' .config('services.wathiq.apiKey').'',
            ),
        ));

        

        $response = curl_exec($curl);
        curl_close($curl);

        if (json_decode($response)) {
            $full_info = new WathiqInfo();
            $full_info->cr_number = $id;
            $full_info->properties = json_encode($response);
            $full_info->save();
        }
        return $response;
    }
    
    public static function getStatus($id){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => config('services.wathiq.url_commercial').'/'.'status/'.$id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'apiKey: ' .config('services.wathiq.apiKey').'',
            ),
        ));

        

        $response = curl_exec($curl);
        curl_close($curl);

        if ($response != NULL) {
            $server_status = json_decode($response);
            $full_info = new WathiqStatus();
            $full_info->cr_number = $id;
            $full_info->status = $server_status->id;
            $full_info->name_ar = $server_status->name;
            $full_info->name_en = $server_status->nameEn;
            $full_info->cancellation = json_encode($server_status->cancellation);
            $full_info->save();
        }
        return $response;
    }

    public static function getManagers($id){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => config('services.wathiq.url_commercial').'/'.'managers/'.$id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'apiKey: ' .config('services.wathiq.apiKey').'',
            ),
        ));

        

        $response = curl_exec($curl);
        curl_close($curl);

        if (is_array(json_decode($response))) {
            foreach (json_decode($response) as $wathiq_manager) {
                $manager = new WathiqManagers();
                $manager->cr_number = $id;
                $manager->name = $wathiq_manager->name;
                $manager->birthDate = $wathiq_manager->birthDate;
                $manager->identity = json_encode($wathiq_manager->identity);
                $manager->relation = json_encode($wathiq_manager->relation);
                $manager->nationality = json_encode($wathiq_manager->nationality);
                $manager->save();
            }
        }
        return $response;
    }
    public static function getOwners($id){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => config('services.wathiq.url_commercial').'/'.'owners/'.$id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'apiKey: ' .config('services.wathiq.apiKey').'',
            ),
        ));

        

        $response = curl_exec($curl);
        curl_close($curl);

        if (is_array(json_decode($response))) {
            foreach (json_decode($response) as $wathiq_owner) {
                $owner = new WathiqOwner();
                $owner->cr_number = $id;
                $owner->gross = $wathiq_owner->gross;
                $owner->shares_count = $wathiq_owner->sharesCount;
                $owner->name = $wathiq_owner->name;
                $owner->birthDate = $wathiq_owner->birthDate;
                $owner->identity = json_encode($wathiq_owner->identity);
                $owner->relation = json_encode($wathiq_owner->relation);
                $owner->nationality = json_encode($wathiq_owner->nationality);
                $owner->save();
            }
        }
        return $response;
    }
    public static function getOwns($id, $idType){
                // dd(config('services.wathiq.url_commercial').'/'.'owns');

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => config('services.wathiq.url_commercial').'/'.'owns/'.$id . '/' . $idType,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'apiKey: ' .config('services.wathiq.apiKey').'',
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        if ($response != NULL) {
                $owner = new WathiqOwn();
                $owner->identity = $id;
                $owner->idtype  = $idType;
                $owner->owns_cr  = $response;
                $owner->save();
        }
        return $response;

    }
}
