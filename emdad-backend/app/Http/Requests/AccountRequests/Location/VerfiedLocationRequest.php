<?php

namespace App\Http\Requests\AccountRequests\Location;

use Carbon\Carbon;
use App\Models\Accounts\CompanyLocations;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class VerfiedLocationRequest extends FormRequest
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
            'id' => ['required','integer','exists:company_locations,id'],
            'userId' => ['required','integer','exists:users,id'],
            'companyId' => ['required','integer','exists:company_info,id']
        ];
    }

    public function withValidator($validator)
    {
        if(!$validator->fails()){
            $validator->after(function ($validator){
                $location = CompanyLocations::where('otp_expires_at','>',Carbon::now()->format('Y-m-d H:i:s'))->where('id','=',$this->get('id'))->first();
                $updateOtp = CompanyLocations::find($this->get('id'));
                if(!$updateOtp->otp_verfied){
                    if(empty($location)){
                        $otp = rand(1000,9999);
                        $otpExpireAt = Carbon::now()->addMinutes(3);
                        $updateOtp->update(['otp_receiver' => $otp,'otp_expires_at' => $otpExpireAt]);
                        $validator->errors()->add('otp expired', 'otp expired , now sended new otp please check your phone');
                    }
                }else{
                    $validator->errors()->add('otp verfied', 'otp already verfied');
                }
            });
        }
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(  response()->json(["success" => false, "errors" => $validator->errors(),"statusCode"=>"422"], 200));
    }
}
