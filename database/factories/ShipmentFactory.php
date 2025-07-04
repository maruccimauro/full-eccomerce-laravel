<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\ShipmentEnum;
use App\Enums\ShipmentStatusEmun;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shipment>
 */
class ShipmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $shipped_at = fake()->dateTimeBetween('2020-01-01', '2025-01-01');
        return [
            ShipmentEnum::TRACKING_NUMBER => fake()->numerify('########################'),
            ShipmentEnum::STATUS => fake()->randomElement(ShipmentStatusEmun::allValuesAsArray()),
            ShipmentEnum::SHIPPED_AT => $shipped_at,
            ShipmentEnum::DELIVERED_AT => fake()->dateTimeBetween($shipped_at, '2025-01-01'),
        ];
    }
}
