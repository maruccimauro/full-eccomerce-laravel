<?php

namespace App\Http\Requests\Address;

use Illuminate\Foundation\Http\FormRequest;
use App\Fields\AddressFields; // Asegurate de importar el enum o clase de constantes

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            AddressFields::USER_ID => 'required|exists:users,id',
            AddressFields::RECIPIENT_NAME => 'required|string|max:255',
            AddressFields::LINE1 => 'required|string|max:255',
            AddressFields::LINE2 => 'nullable|string|max:255',
            AddressFields::CITY => 'required|string|max:100',
            AddressFields::PROVINCE => 'required|string|max:40',
            AddressFields::POSTAL_CODE => 'required|string|max:20',
            AddressFields::COUNTRY => 'required|string|max:40',
            AddressFields::PHONE => 'nullable|string|max:20',
        ];
    }

    public function messages(): array
    {
        return [
            AddressFields::USER_ID . '.required' => 'El campo usuario es obligatorio.',
            AddressFields::USER_ID . '.exists' => 'El usuario seleccionado no existe.',

            AddressFields::RECIPIENT_NAME . '.required' => 'El nombre del destinatario es obligatorio.',
            AddressFields::RECIPIENT_NAME . '.string' => 'El nombre del destinatario debe ser una cadena de texto.',
            AddressFields::RECIPIENT_NAME . '.max' => 'El nombre del destinatario no puede superar los 255 caracteres.',

            AddressFields::LINE1 . '.required' => 'La dirección principal es obligatoria.',
            AddressFields::LINE1 . '.string' => 'La dirección principal debe ser una cadena de texto.',
            AddressFields::LINE1 . '.max' => 'La dirección principal no puede superar los 255 caracteres.',

            AddressFields::LINE2 . '.string' => 'La dirección secundaria debe ser una cadena de texto.',
            AddressFields::LINE2 . '.max' => 'La dirección secundaria no puede superar los 255 caracteres.',

            AddressFields::CITY . '.required' => 'La ciudad es obligatoria.',
            AddressFields::CITY . '.string' => 'La ciudad debe ser una cadena de texto.',
            AddressFields::CITY . '.max' => 'La ciudad no puede superar los 100 caracteres.',

            AddressFields::PROVINCE . '.required' => 'La provincia es obligatoria.',
            AddressFields::PROVINCE . '.string' => 'La provincia debe ser una cadena de texto.',
            AddressFields::PROVINCE . '.max' => 'La provincia no puede superar los 40 caracteres.',

            AddressFields::POSTAL_CODE . '.required' => 'El código postal es obligatorio.',
            AddressFields::POSTAL_CODE . '.string' => 'El código postal debe ser una cadena de texto.',
            AddressFields::POSTAL_CODE . '.max' => 'El código postal no puede superar los 20 caracteres.',

            AddressFields::COUNTRY . '.required' => 'El país es obligatorio.',
            AddressFields::COUNTRY . '.string' => 'El país debe ser una cadena de texto.',
            AddressFields::COUNTRY . '.max' => 'El país no puede superar los 40 caracteres.',

            AddressFields::PHONE . '.string' => 'El teléfono debe ser una cadena de texto.',
            AddressFields::PHONE . '.max' => 'El teléfono no puede superar los 20 caracteres.',
        ];
    }
}
