<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\OrderEnum;
use App\Enums\OrderPaymentStatusEnum;
use App\Enums\OrderStatusEnum;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            OrderEnum::STATUS => fake()->randomElement(OrderStatusEnum::allValuesAsArray()),
            OrderEnum::PAYMENT_METHOD => fake()->randomElement(['MercadoPago', 'Tarjeta de credito']),
            OrderEnum::PAYMENT_STATUS => fake()->randomElement(OrderPaymentStatusEnum::allValuesAsArray()),
        ];
    }
}
