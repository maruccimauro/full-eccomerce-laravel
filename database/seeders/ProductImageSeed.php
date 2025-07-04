<?php

namespace Database\Seeders;

use App\Enums\ProductEnum;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Enums\ProductImageEnum;

class ProductImageSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();
        if ($products->count() === 0) {
            throw new \Exception("Se necesitan products para ejecutar " . static::class);
        }
        $products->each(function ($product) {
            ProductImage::factory()->create([
                ProductImageEnum::PRODUCT_ID => $product->{ProductEnum::ID},
                ProductImageEnum::IS_MAIN => 1,
            ]);

            ProductImage::factory(2)->create([
                ProductImageEnum::PRODUCT_ID => $product->{ProductEnum::ID},
                ProductImageEnum::IS_MAIN => 0,
            ]);
        });
    }
}
