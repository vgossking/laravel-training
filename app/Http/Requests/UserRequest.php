<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {

        if($this->method() == 'PATCH'){
            $id = $this->segment(3);
            $userData = $this->all();
            //check if password blank then not require password
            if($userData['password'] == ""){
                return [
                    //
                    'name' =>'required',
                    'email' =>'required|email|unique:users,email,' . $id,

                ];
            }
            else{
                return [
                    //
                    'name' =>'required',
                    'email' =>'required|email|unique:users,email,' . $id,
                    'password' => 'min:6'
                ];
            }

        }
        return [
            //

            'name' =>'required',
            'email' =>'required|email|unique:users',
            'password'=>'required|min:6'

        ];
    }
}
