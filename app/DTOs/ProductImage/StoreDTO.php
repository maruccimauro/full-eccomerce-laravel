<?php

namespace App\DTOs\ProductImage;

use Illuminate\Http\Request;
use App\Fields\ProductImageFields;
use App\DTOs\BaseDTO;


class StoreDTO
{
  use BaseDTO;

  public function __construct(
    public readonly int $product_id,
    public readonly string $url,
    public readonly bool $is_main,
  ) {}

  public static function fromRequest(Request $request): self
  {
    return new self(
      $request->{ProductImageFields::PRODUCT_ID},
      $request->{ProductImageFields::URL},
      (bool) $request->{ProductImageFields::IS_MAIN},
    );
  }
}
