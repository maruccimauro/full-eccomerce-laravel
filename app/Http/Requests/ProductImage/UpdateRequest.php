<?php

namespace App\Http\Requests\ProductImage;

use App\Fields\ProductImageFields;
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

    public function rules(): array
    {
        return [
            ProductImageFields::PRODUCT_ID => 'required|exists:products,id',
            ProductImageFields::URL        => [
                'required',
                'regex:/^[a-zA-Z0-9_\-]+\.(png|jpg|jpeg|gif)$/i',
                'max:2048',
            ],
            ProductImageFields::IS_MAIN    => 'required|boolean',
        ];
    }


    public function messages(): array
    {
        return [
            ProductImageFields::PRODUCT_ID . '.required' => 'El campo producto es obligatorio.',
            ProductImageFields::PRODUCT_ID . '.exists'   => 'El producto seleccionado no es válido.',

            ProductImageFields::URL . '.required'        => 'La URL de la imagen es obligatoria.',
            ProductImageFields::URL . '.regex'             => 'La URL debe ser válida.',
            ProductImageFields::URL . '.max'             => 'La URL no puede exceder los 2048 caracteres.',

            ProductImageFields::IS_MAIN . '.required'    => 'Debe especificar si la imagen es principal.',
            ProductImageFields::IS_MAIN . '.boolean'     => 'El campo imagen principal debe ser verdadero o falso.',
        ];
    }
}
