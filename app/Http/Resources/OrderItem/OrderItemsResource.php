<?php

namespace App\Http\Resources\OrderItem;

use App\Fields\OrderItemFields;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemsResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array
  {
    return [
      OrderItemFields::ID => $this->{OrderItemFields::ID},
      OrderItemFields::ORDER_ID => $this->{OrderItemFields::ORDER_ID},
      OrderItemFields::PRODUCT_ID => $this->{OrderItemFields::PRODUCT_ID},
      OrderItemFields::QUANTITY => $this->{OrderItemFields::QUANTITY},
      OrderItemFields::UNIT_PRICE => $this->{OrderItemFields::UNIT_PRICE},
      OrderItemFields::TOTAL_PRICE => $this->{OrderItemFields::TOTAL_PRICE},
    ];
  }
}
