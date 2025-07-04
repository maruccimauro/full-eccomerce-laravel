<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Fields\OrderFields;
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
            OrderFields::STATUS => fake()->randomElement(OrderStatusEnum::allValuesAsArray()),
            OrderFields::PAYMENT_METHOD => fake()->randomElement(['MercadoPago', 'Tarjeta de credito']),
            OrderFields::PAYMENT_STATUS => fake()->randomElement(OrderPaymentStatusEnum::allValuesAsArray()),
        ];
    }
}
