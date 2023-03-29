<?php

namespace App\Http\Requests\CategroyRequests\Product;

use App\Rules\IsCompositeUnique;
use App\Rules\UniqeValues;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CompanyProductRequest extends FormRequest
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
            'productId' => ['required_without:productList','exists:products,id', new IsCompositeUnique('product_profile',['profile_id'=>auth()->user()->profile_id,'product_id'=>$this->productId])],

            "productList" => ['required_without:productId', 'array', new UniqeValues, new IsCompositeUnique('product_profile',['profile_id'=>auth()->user()->profile_id,'product_id'=>$this->productList])],
            "productList.*" => ['required_with:productList','exists:products,id'],
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException( response()->json(["success" => false, "errors" => $validator->errors(),"statusCode"=>"422"], 200));

    }
}
