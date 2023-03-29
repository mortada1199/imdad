<?php

namespace App\Http\Requests\General;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class CreateSubPackageRequest extends FormRequest
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
            'packageNameAr'=>['required','unique:subscription_packages,package_name_ar'],
            'packageNameEn'=>['required','unique:subscription_packages,package_name_en'],
            'type'=>['required','string',Rule::in(['Buyer','Supplier'])], // 1 => Buyer, 2 => Supplier
            'features'=>['required'],
            'features.*.key'=>['required','string'],
            'features.*.systemValue'=>['integer'],
            'features.*.titleEn'=>['string'],
            'features.*.titleAr'=>['string'],
            'features.*.descriptionEn'=>['string'],
            'features.*.descriptionAr'=>['string'],
            'features.*.textAr'=>['string'],
            'features.*.textEn'=>['string'],
            'price1'=>"required|regex:/^\d+(\.\d{1,2})?$/",
            'price2'=>"regex:/^\d+(\.\d{1,2})?$/",
            'freeFirstTime'=>['boolean'],
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException( response()->json(["success" => false, "errors" => $validator->errors(),"statusCode"=>"422"], 200));
    }
}
