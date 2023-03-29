<?php

namespace App\Http\Requests\CategroyRequests\Categroy;

use App\Rules\IsCompositeUnique;
use App\Rules\UniqeValues;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProfileCategoryRequest extends FormRequest
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
            'categoryId' => ['required_without:categoryList','exists:categories,id', new IsCompositeUnique('category_profile',['profile_id'=>auth()->user()->profile_id,'category_id'=>$this->categoryId])],

            "categoryList" => ['required_without:categoryId', 'array', new UniqeValues, new IsCompositeUnique('category_profile',['profile_id'=>auth()->user()->profile_id,'category_id'=>$this->categoryList])],
            "categoryList.*" => ['required_with:categoryList','exists:categories,id'],

        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json(["success" => false, "errors" => $validator->errors(),"statusCode"=>"422"], 200));
    }
}
