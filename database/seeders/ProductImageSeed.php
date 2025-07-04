<?php

namespace Database\Seeders;

use App\Fields\ProductFields;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Fields\ProductImageFields;

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
                ProductImageFields::PRODUCT_ID => $product->{ProductFields::ID},
                ProductImageFields::IS_MAIN => 1,
            ]);

            ProductImage::factory(2)->create([
                ProductImageFields::PRODUCT_ID => $product->{ProductFields::ID},
                ProductImageFields::IS_MAIN => 0,
            ]);
        });
    }
}
