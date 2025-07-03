<?php

namespace App\Http\Requests\Address;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'recipient_name' => 'required|string|max:255',
            'line1' => 'required|string|max:255',
            'line2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'province' => 'required|string|max:40',
            'postal_code' => 'required|string|max:20',
            'country' => 'required|string|max:40',
            'phone' => 'nullable|string|max:20'
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'El campo usuario es obligatorio.',
            'user_id.exists' => 'El usuario seleccionado no existe.',

            'recipient_name.required' => 'El nombre del destinatario es obligatorio.',
            'recipient_name.string' => 'El nombre del destinatario debe ser una cadena de texto.',
            'recipient_name.max' => 'El nombre del destinatario no puede superar los 255 caracteres.',

            'line1.required' => 'La dirección principal es obligatoria.',
            'line1.string' => 'La dirección principal debe ser una cadena de texto.',
            'line1.max' => 'La dirección principal no puede superar los 255 caracteres.',

            'line2.string' => 'La dirección secundaria debe ser una cadena de texto.',
            'line2.max' => 'La dirección secundaria no puede superar los 255 caracteres.',

            'city.required' => 'La ciudad es obligatoria.',
            'city.string' => 'La ciudad debe ser una cadena de texto.',
            'city.max' => 'La ciudad no puede superar los 100 caracteres.',

            'province.required' => 'La provincia es obligatoria.',
            'province.string' => 'La provincia debe ser una cadena de texto.',
            'province.max' => 'La provincia no puede superar los 40 caracteres.',

            'postal_code.required' => 'El código postal es obligatorio.',
            'postal_code.string' => 'El código postal debe ser una cadena de texto.',
            'postal_code.max' => 'El código postal no puede superar los 20 caracteres.',

            'country.required' => 'El país es obligatorio.',
            'country.string' => 'El país debe ser una cadena de texto.',
            'country.max' => 'El país no puede superar los 40 caracteres.',

            'phone.string' => 'El teléfono debe ser una cadena de texto.',
            'phone.max' => 'El teléfono no puede superar los 20 caracteres.',
        ];
    }
}
