<?php

namespace App\Http\Requests\AccountRequests\Subscription;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UpdateSubscriptionRequest extends FormRequest
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
            'type' => ['string', Rule::in(['Buyer', 'Supplier'])], // 1 => Buyer, 2 => Supplier
            'features.*.key'=>['required','string'],
            'features.*.systemValue'=>['integer'],
            'features.*.titleEn'=>['string'],
            'features.*.titleAr'=>['string'],
            'features.*.descriptionEn'=>['string'],
            'features.*.descriptionAr'=>['string'],
            'features.*.textAr'=>['string'],
            'features.*.textEn'=>['string'],
            'price1'=>"regex:/^\d+(\.\d{1,2})?$/",
            'price2'=>"regex:/^\d+(\.\d{1,2})?$/",
            'freeFirstTime'=>['boolean'],
            'packageNameAr'=>['unique:subscription_packages,package_name_ar,'.$this->id],
            'packageNameEn'=>['unique:subscription_packages,package_name_en,'.$this->id],
         
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json(["success" => false, "errors" => $validator->errors(),"statusCode"=>"422"], 200));
    }
}
