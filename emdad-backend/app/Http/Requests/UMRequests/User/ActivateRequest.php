<?php

namespace App\Http\Requests\UMRequests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ActivateRequest extends FormRequest
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
            'mobile'=>[ 'required_without:id','string','exists:users,mobile'],
            "id"=>"required_without:mobile|exists:users,id",
            "otp"=>"required|string|min:4|max:50",
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(  response()->json(["success" => false, "errors" => $validator->errors(),"statusCode"=>"422"], 200));
    }
}
