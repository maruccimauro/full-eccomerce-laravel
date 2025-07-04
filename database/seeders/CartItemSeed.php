<?php

namespace Database\Seeders;

use App\Models\CartItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Enums\CartItemEnum;
use App\Models\Product;
use App\Models\Cart;
use App\Enums\CartEnum;
use App\Enums\ProductEnum;

class CartItemSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carts = Cart::all();
        if ($carts->count() === 0) {
            throw new \Exception("Se necesitan carts para ejecutar " . static::class);
        }
        if (Product::count() === 0) {
            throw new \Exception("Se necesitan products para ejecutar " . static::class);
        }

        $carts->each(function ($cart) {
            $products = Product::inRandomOrder()->limit(rand(1, 8))->get();
            foreach ($products as $product) {
                CartItem::factory()->create([
                    CartItemEnum::CART_ID => $cart->{CartEnum::ID},
                    CartItemEnum::PRODUCT_ID => $product->{ProductEnum::ID},
                ]);
            }
        });
    }
}
