<?php
namespace App\Http\Requests\UMRequests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
class DeleteWarehouseRequest extends FormRequest
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
    "userId"=>'required|exists:user_warehouse,user_id,warehouse_id,'.$this['warehouseId'],
    "warehouseId"=>'required|exists:user_warehouse,warehouse_id,user_id,'.$this['userId'],
];
}

protected function failedValidation(Validator $validator): void
{
throw new HttpResponseException(response()->json(["success" => false, "errors" => $validator->errors(),"statusCode"=>"422"], 200));
}
}
