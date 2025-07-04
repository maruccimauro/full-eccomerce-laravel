<?php

namespace Database\Seeders;

use App\Fields\OrderFields;
use App\Fields\OrderItemFields;
use App\Fields\ProductFields;
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
                $productPrice = $product->{ProductFields::PRICE};
                $partialPrice = $productPrice *  $productQuantity;
                $totalPrice += $partialPrice;
                OrderItem::factory()->create([
                    OrderItemFields::ORDER_ID => $order->{OrderFields::ID},
                    OrderItemFields::PRODUCT_ID => $product->{ProductFields::ID},
                    OrderItemFields::QUANTITY => $productQuantity,
                    OrderItemFields::UNIT_PRICE => $productPrice,
                    OrderItemFields::TOTAL_PRICE => $partialPrice
                ]);
            }
            $order->{OrderFields::TOTAL} = $totalPrice;
            $order->save();
        });
    }
}
