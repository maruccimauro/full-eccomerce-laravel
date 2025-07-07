<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Fields\CartFields;
use App\Models\User;
use App\Models\Cart;
use App\Fields\UserFields;

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
            Cart::factory()->create([CartFields::USER_ID => $user->{UserFields::ID}]);
        });
    }
}
