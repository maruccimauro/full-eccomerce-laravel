<?php

namespace Database\Seeders;

use App\Fields\AddressFields;
use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Fields\UserFields;

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
            Address::factory()->create([AddressFields::USER_ID => $user->{UserFields::ID}]);
        });
    }
}
