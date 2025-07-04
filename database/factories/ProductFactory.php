<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Fields\ProductFields;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Fields\CategoryFields;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->words(rand(1, 3), true);
        $category_id =  Category::whereNotNull(CategoryFields::PARENT_ID)->inRandomOrder()->first()->{CategoryFields::ID} ?? null;
        return [
            ProductFields::NAME => $name,
            ProductFields::SLUG => Str::slug($name),
            ProductFields::DESCRIPTION => fake()->paragraph(),
            ProductFields::PRICE => fake()->numberBetween(100, 20000),
            ProductFields::STOCK => fake()->numberBetween(0, 10000),
            ProductFields::CATEGORY_ID => $category_id,
            ProductFields::IS_ACTIVE => fake()->randomElement([0, 1]),

        ];
    }
}
