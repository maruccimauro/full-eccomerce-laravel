<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\PaymentEnum;

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
            PaymentEnum::PAYMENT_GATEWAY => fake()->randomElement(['stripe', 'paypal', 'mercado_pago']),
            PaymentEnum::TRANSACTION_ID => fake()->numerify('####################'),
        ];
    }
}
