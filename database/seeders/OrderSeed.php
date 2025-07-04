<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Order;
use App\Enums\OrderEnum;
use App\Enums\UserEnum;
use App\Enums\AddressEnum;

class OrderSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::with('addresses')->get();

        if ($users->isEmpty()) {
            throw new \Exception('Se necesitan users para ejecutar ' . static::class);
        }

        $users->each(function ($user) {
            $addresses = $user->addresses;

            if ($addresses->isEmpty()) {
                $user_id = $user->{UserEnum::ID};
                throw new \Exception("El usuario [$user_id] no tiene ningun address para alimentar el factory.");
            }

            $ordersToCreate = rand(1, 3);

            for ($i = 0; $i < $ordersToCreate; $i++) {
                Order::factory()->create([
                    OrderEnum::USER_ID    => $user->{UserEnum::ID},
                    OrderEnum::ADDRESS_ID => $addresses->random()->{AddressEnum::ID},
                    OrderEnum::TOTAL      => 9999,
                ]);
            }
        });
    }
}
