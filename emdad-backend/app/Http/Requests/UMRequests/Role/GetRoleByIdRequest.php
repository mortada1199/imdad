<?php

namespace App\Http\Requests\UMRequests\Role;

use App\Rules\CheckUserHasRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class GetRoleByIdRequest extends FormRequest
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

    protected function prepareForValidation() 
    {
        $uri = $this->path();
        $id = $this->id == null ? 1: $this->id;
        if($uri == 'api/v1_0/roles/getByRoleId/'.$id.'' || $uri == 'api/v1_0/roles/delete/'.$id.''){
            $this->merge(['id' => $this->route('id')]);
        }else{
            $this->merge(['type' => $this->route('type')]); 
        }
        
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $type = $this->type == null ? 1 : $this->type;
        $rules =['id' => ['required','integer','exists:roles,id']];
        if($this->isMethod('delete')){
            $rules =['id' => ['required','integer','exists:roles,id']];
        }elseif($this->path() == 'api/v1_0/roles/getByType/'.$type.''){
           // dd('type');
            $rules =['type' => ['required', Rule::in(['emdad', 'supplier', 'buyier'])],];
        }
        //dd($this->path());
        return $rules;
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(  response()->json(["success" => false, "errors" => $validator->errors(),"statusCode"=>"422"], 200));
    }
}
