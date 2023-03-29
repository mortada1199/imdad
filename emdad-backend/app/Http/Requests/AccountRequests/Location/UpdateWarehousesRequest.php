<?php

namespace App\Http\Requests\AccountRequests\Location;

use App\Rules\WarehouseRule;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateWarehousesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'warehouseName' => ['string','max:100', new WarehouseRule('warehouses',['profile_id'=>auth()->user()->profile_id,'address_name'=>$this->warehouseName],$this->id)],
            'warehouseTypeId' => [ 'exists:warehouse_types,id'],
            'latitude' => ['string'],
            'longitude' => ['string'],
            'gateType' => ['string'],
            'receiverName' => ['string','max:25'],
            'receiverPhone' => ['string','max:14','min:14','regex:/^(00966)/'],
            'managerId' => ['integer', 'exists:users,id']

            
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(  response()->json(["success" => false, "errors" => $validator->errors(),"statusCode"=>"422"], 200));
    }
}
