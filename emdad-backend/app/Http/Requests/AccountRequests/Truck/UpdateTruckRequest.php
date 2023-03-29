<?php

namespace App\Http\Requests\AccountRequests\Truck;

use App\Rules\UniqeValues;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UpdateTruckRequest extends FormRequest
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

    protected function prepareForValidation()
    {
        $this->merge(['id' => $this->route('id')]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' =>['string','max:150'],
            'type'=>['string'],
            'class'=>['string'],
            'color'=>['string'],
            'model'=>['string'],
            'size'=>['string'],
            'brand'=>['string'],
            "plateNumber"=>['string'],
            'status'=>[Rule::in(['active','inActive'])],
            'attachementFile'=>['nullable','image','mimes:jpg,png,jpeg,gif,svg','max:5120'],
            "warehouseList" => ['array', new UniqeValues],
            "warehouseList.*" => ['exists:warehouses,id'],
            'warehouseId'=>['exists:warehouses,id']
        ];

    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(  response()->json(["success" => false, "errors" => $validator->errors(),"statusCode"=>"422"], 200));
    }
}
