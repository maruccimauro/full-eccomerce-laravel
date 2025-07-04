<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Order;
use App\Fields\OrderFields;
use App\Fields\UserFields;
use App\Fields\AddressFields;

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
                $user_id = $user->{UserFields::ID};
                throw new \Exception("El usuario [$user_id] no tiene ningun address para alimentar el factory.");
            }

            $ordersToCreate = rand(1, 3);

            for ($i = 0; $i < $ordersToCreate; $i++) {
                Order::factory()->create([
                    OrderFields::USER_ID    => $user->{UserFields::ID},
                    OrderFields::ADDRESS_ID => $addresses->random()->{AddressFields::ID},
                    OrderFields::TOTAL      => 9999,
                ]);
            }
        });
    }
}
