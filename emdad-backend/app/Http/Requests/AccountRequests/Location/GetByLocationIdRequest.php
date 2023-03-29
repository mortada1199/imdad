<?php

// namespace App\Http\Requests\AccountRequests\Location;

// use Carbon\Carbon;
// use Illuminate\Foundation\Http\FormRequest;
// use Illuminate\Contracts\Validation\Validator;
// use Illuminate\Http\Exceptions\HttpResponseException;

// class GetByLocationIdRequest extends FormRequest
// {
//     /**
//      * Determine if the user is authorized to make this request.
//      *
//      * @return bool
//      */
//     public function authorize()
//     {
//         return true;
//     }

//     protected function prepareForValidation()
//     {
//         $uri = $this->path();
//         $id = $this->id == null ? 1 : $this->id;
//         $userId = $this->userId == null ? 1 : $this->userId;
//         $companyId = $this->companyId == null ? 1 : $this->companyId;
//         //dd('api/warehouses/getById/'.$id.'');
//         if($uri == 'api/v1_0/warehouses/getById/'.$id.'' || $uri == 'api/v1_0/warehouses/delete/'.$id.''){
//             $this->merge(['id' => $this->route('id')]);
//         }elseif($uri == 'api/v1_0/warehouses/getByUserId/'.$userId.''){
//             $this->merge(['userId' => $this->route('userId')]);
//         }else{
//             $this->merge(['companyId' => $this->route('companyId')]);
//         }

//     }
//     /**
//      * Get the validation rules that apply to the request.
//      *
//      * @return array<string, mixed>
//      */
//     public function rules()
//     {
//         $userId = $this->userId == null ? "1" : $this->userId;
//         $companyId = $this->companyId == null ? "1" : $this->companyId;
//         $rules =['id' => ['required','integer','exists:company_locations,id']];
//         if($this->path() == 'api/v1_0/warehouses/getByUserId/'.$userId.''){
//             $rules =['userId' => ['required','integer','exists:users,id']];
//         }elseif ($this->path() == 'api/v1_0/warehouses/getByCompanyId/'.$companyId.'') {
//             $rules =['companyId' => ['required','integer','exists:company_info,id']];
//         }
//         return $rules;
//     }

//     protected function failedValidation(Validator $validator): void
//     {
//         throw new HttpResponseException(  response()->json(["success" => false, "errors" => $validator->errors(),"statusCode"=>"422"], 200));
//     }
// }
