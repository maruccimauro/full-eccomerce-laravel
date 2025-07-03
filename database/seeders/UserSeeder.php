<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Enums\UserEnum;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::create([
            UserEnum::NAME => 'admin',
            UserEnum::EMAIL => 'admin@gmail.com',
            UserEnum::EMAIL_VERIFIED_AT => now(),
            UserEnum::PASSWORD => Hash::make('123123'),
            UserEnum::REMEMBER_TOKEN => Str::random(10),
            UserEnum::PHONE => fake()->phoneNumber(),
        ]);

        User::create([
            UserEnum::NAME => 'customer',
            UserEnum::EMAIL => 'customer@gmail.com',
            UserEnum::EMAIL_VERIFIED_AT => now(),
            UserEnum::PASSWORD => Hash::make('123123'),
            UserEnum::REMEMBER_TOKEN => Str::random(10),
            UserEnum::PHONE => fake()->phoneNumber(),
        ]);
        User::factory(100)->create();
    }
}
