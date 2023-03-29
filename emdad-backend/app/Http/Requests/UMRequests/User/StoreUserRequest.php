<?php

namespace App\Http\Requests\UMRequests\User;

use App\Rules\UniqeValues;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;

class   StoreUserRequest extends FormRequest
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
        $rules = [
            'fullName' => ['required','string','max:100'],
            'identityNumber' => ['unique:users,identity_number','string','max:25'],
            'identityType' => ['string'],
            'mobile' => ['unique:users,mobile','required','string','max:14','min:14','regex:/^(00966)/',],
            'email' => ['unique:users,email','required','email','max:100',],
            "roleId"=> "required|integer|exists:roles,id",
            'password'=>'required|string|min:8',
            'expireDate'=>'date',
            'permissions'=>['array',new UniqeValues],
            'permissions.*'=>['string','exists:permissions,label'],
            'isLearning'=>['boolean'],
            'managerUserId'=>'exists:users,id',//
            'warehouseId'=>['array', new UniqeValues],
            'warehouseId.*'=>'exists:warehouses,id',
            "status" => ['required',Rule::in(['active','inActive'])],


        ];
        // dd($this->all());

        return $rules;
    }



    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json(["success"=>false,"errors" => $validator->errors(),"statusCode"=>"422"], 200));
    }
}
