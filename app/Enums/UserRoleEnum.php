<?php

namespace App\Enums;

class UserRoleEnum
{
  use EnumApp;
  public const ADMIN     = 'admin';
  public const CUSTOMER  = 'customer';


  public static function default(): string
  {
    return self::CUSTOMER;
  }
}
