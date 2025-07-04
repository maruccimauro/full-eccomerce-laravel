<?php

namespace Database\Seeders;

use App\Enums\OrderEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Enums\PaymentEnum;
use App\Enums\PaymentStatusEnum;
use App\Models\Order;
use App\Models\Payment;

class PaymentSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /* PaymentEnum::ORDER_ID => 'order_id',
            PaymentEnum::AMOUNT => 'amount',
            PaymentEnum::STATUS => 'status',
            PaymentEnum::PAID_AT => 'paid_at',*/

        $orders = Order::All();
        if ($orders->count() === 0) {
            throw new \Exception("Se necesitan orders para ejecutar " . static::class);
        }


        $orders->collect(function ($order) {

            $status = fake()->randomElement(PaymentStatusEnum::allValuesAsArray());

            Payment::factory()->create([
                PaymentEnum::ORDER_ID => $order->{OrderEnum::ID},
                PaymentEnum::AMOUNT => $order->{OrderEnum::TOTAL},
                PaymentEnum::STATUS => $status,
                PaymentEnum::PAID_AT => $status === PaymentStatusEnum::PAID ? fake()->dateTimeBetween('2020-01-01', '2025-01-01') : null
            ]);
        });
    }
}
