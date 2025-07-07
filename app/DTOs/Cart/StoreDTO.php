<?php

namespace App\DTOs\Cart;

use Illuminate\Http\Request;
use App\Fields\CartFields;
use App\DTOs\BaseDTO;

class StoreDTO
{
  use BaseDTO;

  public function __construct() {}

  public static function fromRequest(Request $request): self
  {
    return new self();
  }
}
