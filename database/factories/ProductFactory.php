<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\ProductEnum;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Enums\CategoryEnum;

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
        $category_id =  Category::whereNotNull(CategoryEnum::PARENT_ID)->inRandomOrder()->first()->{CategoryEnum::ID} ?? null;
        return [
            ProductEnum::NAME => $name,
            ProductEnum::SLUG => Str::slug($name),
            ProductEnum::DESCRIPTION => fake()->paragraph(),
            ProductEnum::PRICE => fake()->numberBetween(100, 20000),
            ProductEnum::STOCK => fake()->numberBetween(0, 10000),
            ProductEnum::CATEGORY_ID => $category_id,
            ProductEnum::IS_ACTIVE => fake()->randomElement([0, 1]),

        ];
    }
}
