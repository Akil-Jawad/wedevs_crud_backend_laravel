<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            //
            'name' => 'required|max:255|string',
            'email' => 'required|string|unique:users',
            'password' => 'required|min:8',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Username is required',
            'name.max' => 'Username must be less than 255 characters',
            'email.required' => 'Email is required',
            'email.unique' => 'Email already exist',
            'password.required' => 'Please insert password',
            'password.min' => 'Password must not be less than 8 characters'
        ];
    }
}
