<?php

namespace App\Http\Requests\Order;

use App\Enums\OrderPaymentMethodEnum;
use App\Fields\OrderFields;
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
            OrderFields::ADDRESS_ID => 'required|exists:addresses,id',
            OrderFields::PAYMENT_METHOD => 'required|' . OrderPaymentMethodEnum::inRule(),
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
            OrderFields::ADDRESS_ID . '.required' => 'El campo dirección es obligatorio.',
            OrderFields::ADDRESS_ID . '.exists' => 'La dirección seleccionada no es válida.',

            OrderFields::PAYMENT_METHOD . '.required' => 'El campo método de pago es obligatorio.',
            OrderFields::PAYMENT_METHOD . '.in' => 'El método de pago no es valido',
        ];
    }
}
