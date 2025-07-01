<?php

namespace App\Enums;

class ShipmentsStatusEmun
{
  use EnumApp;
  public const PENDING     = 'pending';
  public const IN_TRANSIT  = 'in_transit';
  public const DELIVERED   = 'delivered';
  public const FAILED      = 'failed';

  public static function default(): string
  {
    return self::PENDING;
  }
}
