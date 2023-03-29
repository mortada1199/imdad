<?php

namespace App\Http\Requests\CategroyRequests\Product;

use App\Rules\UniqeValues;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateProuductRequest extends FormRequest
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
        // 'categoryId' => 'required|integer|exists:categories,id,isleaf,1',

        return [
            'categoryId' => ['required', 'integer', 'exists:categories,id'],
            'nameEn' => ['required', 'string', 'unique:products,name_en', 'max:50'],
            'nameAr' => ['required', 'string', 'unique:products,name_ar', 'max:50'],
            'price' => ['nullable', 'between:0,99.99'],
            'attachementFile' => ['array'],
            'attachementFile.*' => ['nullable', 'mimes:jpg,png,jpeg,gif,svg', 'max:5120'],
            'measruingUnit' => ['string', 'required' ],
            'descriptionEn' => ['required', 'string', 'max:120'],
            'descriptionAr' => ['required', 'string', 'max:120'],

        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json(["success" => false, "errors" => $validator->errors(), "statusCode" => "422"], 200));
    }
}
