<?php

namespace App\Enums;

class PaymentStatusEnum
{
  use EnumApp;
  public const PENDING   = 'pending';
  public const COMPLETED = 'completed';
  public const FAILED    = 'failed';

  public static function default(): string
  {
    return self::PENDING;
  }
}
