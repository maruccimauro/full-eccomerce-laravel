<?php

namespace App\Http\Requests\Category;

use App\Fields\CategoryFields;
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
            CategoryFields::ID => 'required|exists:categories,id',
            CategoryFields::NAME => 'required|max:40',
            CategoryFields::PARENT_ID => 'nullable|exists:categories,id',
        ];
    }

    public function messages(): array
    {
        return [
            CategoryFields::ID . '.required' => 'El campo id es requerido.',
            CategoryFields::ID . '.exists' => 'El id ingresado no es valido.',
            CategoryFields::NAME . '.required' => 'El campo nombre es requerido.',
            CategoryFields::NAME . '.max' => 'El campo nombre no puede exceder de los 40 caracteres.',
            CategoryFields::PARENT_ID . '.exists' => 'El parent_id ingresado no es valido.'
        ];
    }
}
