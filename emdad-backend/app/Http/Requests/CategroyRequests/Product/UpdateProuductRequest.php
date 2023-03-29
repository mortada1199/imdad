<?php

namespace App\Http\Requests\CategroyRequests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateProuductRequest extends FormRequest
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
            'categoryId' => 'integer|exists:categories,id,isleaf,1',
            'nameEn' => 'string|unique:products,name_en',
            'nameAr' => 'string|unique:products,name_ar',
            'price' => 'integer',
            'measruingUnit' => ['string'],
            'attachementFile' => 'nullable',
            'descriptionEn' => ['string'],
            'descriptionAr' => ['string']
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json(["success" => false, "errors" => $validator->errors(),"statusCode"=>"422"], 200));
    }
}
