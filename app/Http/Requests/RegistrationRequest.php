<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ];
    }
    public function messages()
    {
        return [
            'email.required' => 'email address is required !',
            'email.email' => 'email address is not valide :: example@email.com',
            'email.unique' => 'Looks like this email address already exists !',
            'name.required' => 'Please provide a user name !',
            'name.string' => 'User_name is not valide ! Numbers are not allowed',
            'password.required' => 'password required',
            'password.min' => 'password not strong enough !',
        ];
    }
}
