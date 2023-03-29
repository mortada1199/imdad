<?php

namespace App\Http\Requests\CouponRequests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class CreateCouponRequest extends FormRequest
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
                'allowed' => 'required|integer',
                'startDate' => 'required|',
                'endDate' => 'required|after_or_equal:'.$this->stratDate.'',
                'value'=>'required|integer',
                'isPercentage'=>'required|boolean'
            ];
        return $rules;
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(["success"=>false,"errors" => $validator->errors()], 404));
    }}
