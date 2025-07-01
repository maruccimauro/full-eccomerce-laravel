<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRegisterRequest extends FormRequest
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
            'email' => 'required|email|exists:users,email',
            'password' => 'required'
        ];
    }

    public function message(): array
    {
        return [
            'email.required' => 'El campo email es requerido.',
            'email.email' => 'El email ingresado no es correcto.',
            'email.exists' => 'El email ingresado no es correcto.',
            'password.required' => 'El campo password es requerido.'
        ];
    }
}
