<?php

namespace Database\Seeders;

use App\Enums\UserRoleEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Fields\UserFields;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $admin = User::create([
            UserFields::NAME => 'admin',
            UserFields::EMAIL => 'admin@gmail.com',
            UserFields::EMAIL_VERIFIED_AT => now(),
            UserFields::PASSWORD => Hash::make('123123'),
            UserFields::REMEMBER_TOKEN => Str::random(10),
            UserFields::PHONE => fake()->phoneNumber(),
        ]);
        Role::create(['name' => UserRoleEnum::ADMIN]);
        $admin->assignRole(UserRoleEnum::ADMIN);
        User::create([
            UserFields::NAME => 'customer',
            UserFields::EMAIL => 'customer@gmail.com',
            UserFields::EMAIL_VERIFIED_AT => now(),
            UserFields::PASSWORD => Hash::make('123123'),
            UserFields::REMEMBER_TOKEN => Str::random(10),
            UserFields::PHONE => fake()->phoneNumber(),
        ]);
        User::factory(100)->create();
    }
}
