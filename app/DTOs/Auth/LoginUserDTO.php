<?php

namespace App\DTOs\Auth;

use Illuminate\Http\Request;

class LoginUserDTO
{
  public readonly string $email;
  public readonly string $password;



  public function __construct(
    string $email,
    string $password,
  ) {
    $this->email = $email;
    $this->password = $password;
  }

  public static function fromRequest(Request $request)
  {
    return new self(
      email: $request->input('email'),
      password: $request->input('password'),
    );
  }
}
