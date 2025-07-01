<?php

namespace App\Enums;

class OrderStatusEnum
{
    use EnumApp;
    public const PENDING   = 'pending';
    public const PAID      = 'paid';
    public const SHIPPED   = 'shipped';
    public const DELIVERED = 'delivered';
    public const CANCELLED = 'cancelled';

    public static function default(): string
    {
        return self::PENDING;
    }
}
