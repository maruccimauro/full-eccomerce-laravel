<?php

namespace App\DTOs\CartItem;

use Illuminate\Http\Request;
use App\Fields\CartItemFields;
use App\DTOs\BaseDTO;

class StoreDTO
{
  use BaseDTO;

  public function __construct(

    public readonly int $product_id,
    public readonly int $quantity,
  ) {}

  public static function fromRequest(Request $request): self
  {
    return new self(
      $request->{CartItemFields::PRODUCT_ID},
      (int) $request->{CartItemFields::QUANTITY}
    );
  }
}
