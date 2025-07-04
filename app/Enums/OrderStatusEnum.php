<?php

namespace App\Enums;

class OrderStatusEnum
{
    use EnumApp;
    public const PENDING    = 'pending';    // Orden creada, aun no procesada
    public const PAID       = 'paid';       // Orden pagada, pendiente de envío
    public const SHIPPED    = 'shipped';    // Orden despachada al cliente
    public const PROCESSING = 'processing'; // Orden en preparación o armado
    public const DELIVERED  = 'delivered';  // Orden entregada al cliente final
    public const CANCELLED  = 'cancelled';  // Orden cancelada antes del envío
    public const RETURNED   = 'returned';   // Orden devuelta por el cliente

    public static function default(): string
    {
        return self::PENDING;
    }
}
