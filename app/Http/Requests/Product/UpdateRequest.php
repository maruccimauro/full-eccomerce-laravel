<?php

namespace App\Http\Requests\Product;

use App\Fields\ProductFields;
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
            ProductFields::NAME        => 'required|string|max:100',
            ProductFields::DESCRIPTION => 'nullable|string|max:500',
            ProductFields::PRICE       => 'required|numeric|min:0',
            ProductFields::STOCK       => 'required|integer|min:0',
            ProductFields::CATEGORY_ID => 'required|exists:categories,id',
            ProductFields::IS_ACTIVE   => 'required|boolean',
        ];
    }

    public function messages(): array
    {
        return [

            ProductFields::NAME . '.required'        => 'El campo nombre es requerido.',
            ProductFields::NAME . '.string'          => 'El nombre debe ser una cadena de texto.',
            ProductFields::NAME . '.max'             => 'El nombre no puede exceder los 100 caracteres.',

            ProductFields::DESCRIPTION . '.string'   => 'La descripción debe ser una cadena de texto.',
            ProductFields::DESCRIPTION . '.max'      => 'La descripción no puede exceder los 500 caracteres.',

            ProductFields::PRICE . '.required'       => 'El precio es obligatorio.',
            ProductFields::PRICE . '.numeric'        => 'El precio debe ser un número.',
            ProductFields::PRICE . '.min'            => 'El precio no puede ser negativo.',

            ProductFields::STOCK . '.required'       => 'El stock es obligatorio.',
            ProductFields::STOCK . '.integer'        => 'El stock debe ser un número entero.',
            ProductFields::STOCK . '.min'            => 'El stock no puede ser negativo.',

            ProductFields::CATEGORY_ID . '.required' => 'La categoría es obligatoria.',
            ProductFields::CATEGORY_ID . '.exists'   => 'La categoría seleccionada no es válida.',

            ProductFields::IS_ACTIVE . '.required'   => 'El estado de activación es obligatorio.',
            ProductFields::IS_ACTIVE . '.boolean'    => 'El estado de activación debe ser verdadero o falso.',
        ];
    }
}
