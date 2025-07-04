<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Fields\PaymentFields;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            PaymentFields::PAYMENT_GATEWAY => fake()->randomElement(['stripe', 'paypal', 'mercado_pago']),
            PaymentFields::TRANSACTION_ID => fake()->numerify('####################'),
        ];
    }
}
