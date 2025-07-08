<?php

namespace App\DTOs\Order;

use Illuminate\Http\Request;
use App\Fields\OrderFields;
use App\DTOs\BaseDTO;


class StoreDTO
{
  use BaseDTO;

  public function __construct(
    public readonly int $address_id,
    public readonly string $payment_method,
  ) {}

  public static function fromRequest(Request $request): self
  {
    return new self(
      $request->{OrderFields::ADDRESS_ID},
      $request->{OrderFields::PAYMENT_METHOD},
    );
  }
}
