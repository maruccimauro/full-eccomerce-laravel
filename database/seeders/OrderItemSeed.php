<?php

namespace Database\Seeders;

use App\Enums\OrderEnum;
use App\Enums\OrderItemEnum;
use App\Enums\ProductEnum;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderItemSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = Order::all();
        $products = Product::all();
        if ($orders->count() === 0) {
            throw new \Exception('Se necesitan orders para ejecutar ' . static::class);
        }

        if ($products->count() === 0) {
            throw new \Exception('Se necesitan products para ejecutar ' . static::class);
        }

        $orders->each(function ($order) use ($products) {
            $maxProductosToCreate = 10;
            $productsToCreate = rand(1, $maxProductosToCreate);
            $totalPrice = 0;
            for ($i = 0; $i < $productsToCreate; $i++) {
                $product = $products->random();
                $productQuantity = rand(1, 5);
                $productPrice = $product->{ProductEnum::PRICE};
                $partialPrice = $productPrice *  $productQuantity;
                $totalPrice += $partialPrice;
                OrderItem::factory()->create([
                    OrderItemEnum::ORDER_ID => $order->{OrderEnum::ID},
                    OrderItemEnum::PRODUCT_ID => $product->{ProductEnum::ID},
                    OrderItemEnum::QUANTITY => $productQuantity,
                    OrderItemEnum::UNIT_PRICE => $productPrice,
                    OrderItemEnum::TOTAL_PRICE => $partialPrice
                ]);
            }
            $order->{OrderEnum::TOTAL} = $totalPrice;
            $order->save();
        });
    }
}
