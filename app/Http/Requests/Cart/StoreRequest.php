<?php

namespace App\Http\Requests\Cart;

use App\Fields\CartFields;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            CartFields::USER_ID => 'required|exists:users,id',
        ];
    }

    public function messages(): array
    {
        return [
            CartFields::USER_ID . '.required' => 'El campo usuario es obligatorio.',
            CartFields::USER_ID . '.exists' => 'El usuario seleccionado no es válido.',
        ];
    }
}
