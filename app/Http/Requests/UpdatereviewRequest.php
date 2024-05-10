<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdatereviewRequest extends FormRequest
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
        // if($this->satr == null)
        //   $this->request->remove('star');  

        return [     
                'content'  =>['max:200'],
                'star'     =>'nullable|integer|between:1,5|'
        ];
    }
        public function failedValidation(Validator $validator)

        {
            throw new HttpResponseException(response()->json([
    
                'success'   => false,
                'message'   => 'Filter Validation errors',
                'data'      => $validator->errors(),
                'status'    => 400
    
            ]));
    
        }
    
}
