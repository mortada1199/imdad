<?php

namespace App\Http\Requests\Driver;

use App\Rules\UniqeValues;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule as ValidationRule;

class CreateDriverRequest extends FormRequest
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
            'nameAr' => ['required', 'string', 'max:255'],
            'nameEn' => ['required', 'string', 'max:255'],
            'age' => ['required', 'numeric'],
            'phone' => ['unique:drivers,phone', 'required', 'string', 'max:14', 'min:14', 'regex:/^(00966)/',],
            'nationality' => ['required', 'string', 'max:255'],
            'status' => ['required','string',ValidationRule::in(['active','inActive'])],
            'user_id'=>[ 'required','integer','exists:users,id'],
            "warehouseList" => ['array', new UniqeValues],
            "warehouseList.*" => ['exists:warehouses,id'],
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(  response()->json(["success" => false, "errors" => $validator->errors(),"statusCode"=>"422"], 200));
    }
}
