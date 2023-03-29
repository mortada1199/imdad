<?php

namespace App\Http\Requests\UMRequests\User;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
class UploadlogoRequest extends FormRequest
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
    'logo'=>['nullable','image','mimes:jpg,png,jpeg,gif,svg','max:5120','required'  ]
];
}

protected function failedValidation(Validator $validator): void
{
throw new HttpResponseException(response()->json(["success" => false, "errors" => $validator->errors(),"statusCode"=>"422"], 200));
}
}
