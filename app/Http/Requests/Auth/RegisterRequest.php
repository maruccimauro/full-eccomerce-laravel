<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|min:3',
            'email' => 'required|unique:users,email|email',
            'password' => 'required|confirmed|min:6',
            'phone' => 'nullable|regex:/^\+?[0-9]{10,15}$/',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El campo name es requerido.',
            'name.min' => 'El campo name debe contener al menos 3 caracteres.',
            'email.required' => 'El campo email es requerido.',
            'email.unique' => 'El campo email ya esta en uso.',
            'email.email' => 'Debes ingresar un email valido.',
            'password.required' => 'El campo password es requerido.',
            'password.confirmed' => 'Los campos password y password_confirmation no coinciden.',
            'phone.regex' => 'Debes ingresar un phone valido.',
        ];
    }
}
