<?php

namespace App\Http\Requests\Address;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\AddressEnum; // Asegurate de importar el enum o clase de constantes

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            AddressEnum::USER_ID => 'required|exists:users,id',
            AddressEnum::RECIPIENT_NAME => 'required|string|max:255',
            AddressEnum::LINE1 => 'required|string|max:255',
            AddressEnum::LINE2 => 'nullable|string|max:255',
            AddressEnum::CITY => 'required|string|max:100',
            AddressEnum::PROVINCE => 'required|string|max:40',
            AddressEnum::POSTAL_CODE => 'required|string|max:20',
            AddressEnum::COUNTRY => 'required|string|max:40',
            AddressEnum::PHONE => 'nullable|string|max:20',
        ];
    }

    public function messages(): array
    {
        return [
            AddressEnum::USER_ID . '.required' => 'El campo usuario es obligatorio.',
            AddressEnum::USER_ID . '.exists' => 'El usuario seleccionado no existe.',

            AddressEnum::RECIPIENT_NAME . '.required' => 'El nombre del destinatario es obligatorio.',
            AddressEnum::RECIPIENT_NAME . '.string' => 'El nombre del destinatario debe ser una cadena de texto.',
            AddressEnum::RECIPIENT_NAME . '.max' => 'El nombre del destinatario no puede superar los 255 caracteres.',

            AddressEnum::LINE1 . '.required' => 'La dirección principal es obligatoria.',
            AddressEnum::LINE1 . '.string' => 'La dirección principal debe ser una cadena de texto.',
            AddressEnum::LINE1 . '.max' => 'La dirección principal no puede superar los 255 caracteres.',

            AddressEnum::LINE2 . '.string' => 'La dirección secundaria debe ser una cadena de texto.',
            AddressEnum::LINE2 . '.max' => 'La dirección secundaria no puede superar los 255 caracteres.',

            AddressEnum::CITY . '.required' => 'La ciudad es obligatoria.',
            AddressEnum::CITY . '.string' => 'La ciudad debe ser una cadena de texto.',
            AddressEnum::CITY . '.max' => 'La ciudad no puede superar los 100 caracteres.',

            AddressEnum::PROVINCE . '.required' => 'La provincia es obligatoria.',
            AddressEnum::PROVINCE . '.string' => 'La provincia debe ser una cadena de texto.',
            AddressEnum::PROVINCE . '.max' => 'La provincia no puede superar los 40 caracteres.',

            AddressEnum::POSTAL_CODE . '.required' => 'El código postal es obligatorio.',
            AddressEnum::POSTAL_CODE . '.string' => 'El código postal debe ser una cadena de texto.',
            AddressEnum::POSTAL_CODE . '.max' => 'El código postal no puede superar los 20 caracteres.',

            AddressEnum::COUNTRY . '.required' => 'El país es obligatorio.',
            AddressEnum::COUNTRY . '.string' => 'El país debe ser una cadena de texto.',
            AddressEnum::COUNTRY . '.max' => 'El país no puede superar los 40 caracteres.',

            AddressEnum::PHONE . '.string' => 'El teléfono debe ser una cadena de texto.',
            AddressEnum::PHONE . '.max' => 'El teléfono no puede superar los 20 caracteres.',
        ];
    }
}
