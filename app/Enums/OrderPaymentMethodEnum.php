<?php

namespace App\Enums;

class OrderPaymentMethodEnum
{
    use EnumApp;

    public const CASH = "cash";                     // Efectivo contra entrega
    public const CREADIT_CARD = "credit_card";      // Tarjeta de crédito
    public const DEBIT_CARD = "debit_card";         // Tarjeta de débito
    public const BANK_TRANSFER = "bank_transfer";   // Transferencia bancaria
    public const PAYPAL = "paypal";                 // Pago por PayPal
    public const MERCADOPAGO = "mercadopago";       // MERCADO PAGO


    public static function default(): string
    {
        return self::CREADIT_CARD;
    }
}
