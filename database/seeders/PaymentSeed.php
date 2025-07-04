<?php

namespace Database\Seeders;

use App\Fields\OrderFields;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Fields\PaymentFields;
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

        $orders = Order::All();
        if ($orders->count() === 0) {
            throw new \Exception("Se necesitan orders para ejecutar " . static::class);
        }


        $orders->collect(function ($order) {

            $status = fake()->randomElement(PaymentStatusEnum::allValuesAsArray());

            Payment::factory()->create([
                PaymentFields::ORDER_ID => $order->{OrderFields::ID},
                PaymentFields::AMOUNT => $order->{OrderFields::TOTAL},
                PaymentFields::STATUS => $status,
                PaymentFields::PAID_AT => $status === PaymentStatusEnum::PAID ? fake()->dateTimeBetween('2020-01-01', '2025-01-01') : null
            ]);
        });
    }
}
