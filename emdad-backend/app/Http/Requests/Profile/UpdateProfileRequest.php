<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
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
        // dd($this);
        return [
            'logo' =>'image|mimes:jpg,png,jpeg,gif,svg|max:5120',
            'nameAr' => ['string','max:100','unique:profiles,name_ar'],
            'nameEn' => ['string','max:100','unique:profiles,name_en'],
            'swift' => ['string','max:25','unique:profiles,swift'],
            'iban' => ['string','max:25','unique:profiles,iban'],
            'type' => [Rule::in('Buyer','suppiler')],
            'bank' => ['unique:profiles,bank'],
            'subscriptionDetails' => ['unique:profiles,subscription_details'],
            'vatNumber' => ['string','max:25','unique:profiles,vat_number'],
            'active' => ['string','max:25','unique:profiles,active'],
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(  response()->json(["success" => false, "errors" => $validator->errors(),"statusCode"=>"422"], 200));
    }
}
