<?php

namespace Database\Factories;

use App\Fields\AddressFields;
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
            AddressFields::RECIPIENT_NAME => fake()->name(),
            AddressFields::LINE1 => fake()->address(),
            AddressFields::LINE2 => fake()->address(),
            AddressFields::CITY => fake()->city(),
            AddressFields::PROVINCE => fake()->city(),
            AddressFields::POSTAL_CODE => fake()->postcode(),
            AddressFields::COUNTRY => fake()->country(),
            AddressFields::PHONE => fake()->phoneNumber(),
        ];
    }
}
