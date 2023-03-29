<?php

namespace App\Http\Requests\AccountRequests\Truck;

use App\Rules\UniqeValues;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class CreateTruckRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:150'],
            'type' => ['required', 'string'],
            'class' => ['required', 'string'],
            'color' => ['required', 'string'],
            'model' => ['required', 'string'],
            'size' => ['required', 'string'],
            'brand' => ['required', 'string'],
            "plateNumber" => ['required', 'string'],
            'status' => ['required', Rule::in(['active', 'inActive'])],
            'attachementFile' => ['array'],
            'attachementFile.*' => ['nullable', 'mimes:jpg,png,jpeg,gif,svg', 'max:5120'],
            "warehouseList" => ['array', new UniqeValues],
            "warehouseList.*" => ['exists:warehouses,id'],
            'warehouseId' => ['exists:warehouses,id']
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json(["success" => false, "errors" => $validator->errors(), "statusCode" => "422"], 200));
    }
}
