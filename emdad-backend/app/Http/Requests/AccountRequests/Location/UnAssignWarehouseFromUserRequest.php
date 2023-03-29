<?php

namespace App\Http\Requests\AccountRequests\Location;

use App\Rules\IsCompositeUnique;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UnAssignWarehouseFromUserRequest extends FormRequest
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
            'userId' => ['required','integer','exists:users,id','exists:user_warehouse,user_id'],
            'warehouseId' => ['required','integer','exists:warehouses,id', 'exists:user_warehouse,warehouse_id'],
      
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(  response()->json(["success" => false, "errors" => $validator->errors(),"statusCode"=>"422"], 200));
    }
}
