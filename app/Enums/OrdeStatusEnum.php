<?php

namespace App\Enums;

class OrderStatusEnum
{
    public const PENDING   = 'pending';
    public const PAID      = 'paid';
    public const SHIPPED   = 'shipped';
    public const DELIVERED = 'delivered';
    public const CANCELLED = 'cancelled';

    use EnumApp;
}
