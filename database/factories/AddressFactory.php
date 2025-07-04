<?php

namespace Database\Factories;

use App\Enums\AddressEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            AddressEnum::RECIPIENT_NAME => fake()->name(),
            AddressEnum::LINE1 => fake()->address(),
            AddressEnum::LINE2 => fake()->address(),
            AddressEnum::CITY => fake()->city(),
            AddressEnum::PROVINCE => fake()->city(),
            AddressEnum::POSTAL_CODE => fake()->postcode(),
            AddressEnum::COUNTRY => fake()->country(),
            AddressEnum::PHONE => fake()->phoneNumber(),
        ];
    }
}
