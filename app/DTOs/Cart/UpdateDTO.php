<?php

namespace App\DTOs\Cart;

use Illuminate\Http\Request;
use App\Fields\CartFields;
use App\DTOs\BaseDTO;

class UpdateDTO
{
  use BaseDTO;

  public function __construct(
    public readonly int $user_id,
  ) {}

  public static function fromRequest(Request $request): self
  {
    return new self(
      $request->{CartFields::USER_ID}
    );
  }
}
