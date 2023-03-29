<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateAccountRequest extends FormRequest
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
            'firstName' => ['required','string','max:100'],
            'companyName' => ['string','max:100'],
            'lastName' => ['required','string','max:25'],
            'companyType' => ['required','','between:0,2'],
            'roleId' => ['required','integer','between:1,3'],
            'personId' => ['required','string','max:25'],
            'idType' => ['required','string','max:100'],
            'contactPhone' => ['required','string','max:14','min:14','regex:/^(00966)/','unique:users,mobile'],
            'contactEmail' => ['required','email','max:100','unique:users,email'],
            'subscriptionId' =>['integer','exists:subscription_packages,id'],
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(  response()->json(["success" => false, "errors" => $validator->errors(),"statusCode"=>"422"], 200));
    }
}
