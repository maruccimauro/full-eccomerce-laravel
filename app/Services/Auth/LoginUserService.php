<?php

namespace App\Services\Auth;

use App\DTOs\Auth\LoginUserDTO;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class LoginUserService
{
  public function execute(LoginUserDTO $dto)
  {
    $user = User::where('email', $dto->email)->first();
    if (!$user) {
      throw new HttpResponseException(response()->json(['message' => 'El email ingresado no esta registrado'], Response::HTTP_UNAUTHORIZED));
    }
    if (!Hash::check($dto->password, $user->password)) {
      throw new HttpResponseException(response()->json(['message' => 'La contraseña ingresada es incorrecta'], Response::HTTP_UNAUTHORIZED));
    }
    $token = $user->createToken('auth_token')->plainTextToken;
    if (!$token) {
      throw new HttpResponseException(response()->json(['message' => 'Erorr al intentar generar el token'], Response::HTTP_INTERNAL_SERVER_ERROR));
    }
    return [
      'user' => $user,
      'token' => $token
    ];
  }
}
