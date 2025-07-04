<?php

namespace Database\Seeders;

use App\Fields\OrderFields;
use App\Fields\ShipmentFields;
use App\Models\Order;
use App\Models\Shipment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShipmentSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = Order::all();
        if ($orders->count() === 0) {
            throw new \Exception('Se necesitan orders para ejecuar ' . static::class);
        }
        $orders->each(function ($order) {
            Shipment::factory()->create([
                ShipmentFields::ORDER_ID => $order->{OrderFields::ID}
            ]);
        });
    }
}
