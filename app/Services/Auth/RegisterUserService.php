<?php

namespace App\Services\Auth;

use App\Models\User;
use App\DTOs\Auth\RegisterUserDTO;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterUserService
{
  public function execute(RegisterUserDTO $dto): array
  {
    return DB::transaction(function () use ($dto) {
      $user = User::create([
        'name'     => $dto->name,
        'email'    => $dto->email,
        'password' => Hash::make($dto->password),
        'phone' => $dto->phone
      ]);

      $token = $user->createToken('auth_token')->plainTextToken;

      return [
        'user'  => $user,
        'token' => $token
      ];
    });
  }
}
