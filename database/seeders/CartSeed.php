<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Enums\CartEnum;
use App\Models\User;
use App\Models\Cart;
use App\Enums\UserEnum;

class CartSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $users = User::all();
        if ($users->count() === 0) {
            throw new \Exception("Se necesitan usuarios para ejecutar " . static::class);
        }
        $users->each(function ($user) {
            if (rand(0, 1)) {
                Cart::factory()->create([CartEnum::USER_ID => $user->{UserEnum::ID}]);
            }
        });
    }
}
