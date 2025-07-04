<?php

namespace App\Enums;

class OrderPaymentStatusEnum
{
    use EnumApp;

    public const UNPAID    = 'unpaid';    // Aun no se ha realizado el pago
    public const PENDING   = 'pending';   // Pago iniciado, esperando confirmación (ej: transferencia)
    public const PAID      = 'paid';      // Pago recibido correctamente
    public const FAILED    = 'failed';    // Intento de pago fallido (tarjeta rechazada, etc.)
    public const REFUNDED  = 'refunded';  // Pago reembolsado al cliente

    public static function default(): string
    {
        return self::UNPAID;
    }
}
