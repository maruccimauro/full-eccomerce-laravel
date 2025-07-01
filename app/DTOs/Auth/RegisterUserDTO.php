<?php

namespace App\DTOs\Auth;

use Illuminate\Http\Request;

class RegisterUserDTO
{
  public readonly string $name;
  public readonly string $email;
  public readonly string $password;
  public readonly string $phone;


  public function __construct(
    string $name,
    string $email,
    string $password,
    string $phone
  ) {
    $this->name = $name;
    $this->email = $email;
    $this->password = $password;
    $this->phone = $phone;
  }

  public static function fromRequest(Request $request)
  {
    return new self(
      name: $request->input('name'),
      email: $request->input('email'),
      password: $request->input('password'),
      phone: $request->input('phone')
    );
  }
}
