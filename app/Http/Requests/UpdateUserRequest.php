<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
       
        if($this->password == null)
        {
            $this->request->remove('password');
            
        }   
        
    return [
       'name' => [ 'string', 'max:255'],
       'email' => ['sometimes','string','email','max:255', Rule::unique('users')->ignore($this->route('user'))],
       'password' => 'confirmed|min:6|nullable'  ,
       'roles' => 'required'
    ];
    }


}
