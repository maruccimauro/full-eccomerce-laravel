<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Fields\ShipmentFields;
use App\Enums\ShipmentStatusEnum;

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
            ShipmentFields::TRACKING_NUMBER => fake()->numerify('########################'),
            ShipmentFields::STATUS => fake()->randomElement(ShipmentStatusEnum::allValuesAsArray()),
            ShipmentFields::SHIPPED_AT => $shipped_at,
            ShipmentFields::DELIVERED_AT => fake()->dateTimeBetween($shipped_at, '2025-01-01'),
        ];
    }
}
