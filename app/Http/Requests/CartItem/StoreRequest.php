<?php

namespace App\Http\Requests\CartItem;

use App\Fields\CartItemFields;
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            CartItemFields::PRODUCT_ID => 'required|exists:products,id',
            CartItemFields::QUANTITY => 'required|integer|min:1',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [

            CartItemFields::PRODUCT_ID . '.required' => 'El campo ID del producto es obligatorio.',
            CartItemFields::PRODUCT_ID . '.exists' => 'El producto seleccionado no es válido.',

            CartItemFields::QUANTITY . '.required' => 'El campo cantidad es obligatorio.',
            CartItemFields::QUANTITY . '.integer' => 'La cantidad debe ser un número entero.',
            CartItemFields::QUANTITY . '.min' => 'La cantidad debe ser al menos 1.',
        ];
    }
}
