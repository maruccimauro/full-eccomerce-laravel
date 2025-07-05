<?php

namespace App\DTOs\Product;

use Illuminate\Http\Request;
use App\Fields\ProductFields;
use App\DTOs\BaseDTO;

class StoreDTO
{
  use BaseDTO;

  public function __construct(
    public readonly string $name,
    public readonly ?string $description,
    public readonly float $price,
    public readonly int $stock,
    public readonly ?int $category_id,
    public readonly bool $is_active,
  ) {}

  public static function fromRequest(Request $request): self
  {
    return new self(
      $request->{ProductFields::NAME},
      $request->{ProductFields::DESCRIPTION},
      (float) $request->{ProductFields::PRICE},
      (int) $request->{ProductFields::STOCK},
      $request->{ProductFields::CATEGORY_ID},
      (bool) $request->{ProductFields::IS_ACTIVE}
    );
  }
}
