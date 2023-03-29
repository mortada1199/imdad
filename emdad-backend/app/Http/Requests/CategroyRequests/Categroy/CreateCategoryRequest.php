<?php

namespace App\Http\Requests\CategroyRequests\Categroy;

use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateCategoryRequest extends FormRequest
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
                'nameEn' => ['required', 'string', 'max:255','unique:categories,name_en'],
                'nameAr' => ['required', 'string', 'max:255','unique:categories,name_ar'],
                'parentId' => ['exists:categories,id'],
                'isleaf' => ['boolean'],
                'note'  =>  ['required', 'string'],
                'type' => ['string',Rule::in(['products','services'])],

            ];
        }

        protected function failedValidation(Validator $validator): void
        {
            throw new HttpResponseException(  response()->json(["success" => false, "errors" => $validator->errors(),"statusCode"=>"422"], 200));
        }
}
