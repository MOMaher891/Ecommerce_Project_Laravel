<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class validationRequests extends FormRequest
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
        return [
            'email'=>'required|email',
            'password'=>'required',
            'name'=>'required|max:25|min:8',
            'confirm_password'=>'required|same:password'
        ];
    }
    public function messages()
    {
        return [
            'email.required'=>__('auth.required'),
            'name.required'=>__('auth.required'),
            'email.email'=>__('auth.email'),
            'confirm_password.string'=>__('auth.string'),
            'password.required'=>__('auth.required'),
            'confirm_password.required'=>__('auth.required'),
            'password.max'=>__('auth.password_length'),
            'password.min'=>__('auth.password_length'),
            'confirm_password'=>__('auth.confirm_password'),
            // 'email.required'=>__('auth.required'),
        ];
    }
}
