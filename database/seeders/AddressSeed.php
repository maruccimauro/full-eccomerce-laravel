<?php

namespace Database\Seeders;

use App\Enums\AddressEnum;
use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Enums\UserEnum;

class AddressSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        if ($users->count() === 0) {
            throw new \Exception('se necesitan users para realizar ' . static::class);
        }

        $users->each(function ($user) {
            Address::factory()->create([AddressEnum::USER_ID => $user->{UserEnum::ID}]);
        });
    }
}
