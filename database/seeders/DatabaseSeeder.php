<?php

namespace Database\Seeders;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CategorySeed::class,
            ProductSeed::class,
            ProductImageSeed::class,
            CartSeed::class,
            CartItemSeed::class,
            AddressSeed::class,
            OrderSeed::class,
            OrderItemSeed::class,
            ShipmentSeed::class,
            PaymentSeed::class,
            TagSeed::class
        ]);
    }
}
