<?php

namespace App\Http\Resources\CartItem;

use App\Fields\CartItemFields;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            CartItemFields::ID => $this->{CartItemFields::ID},
            CartItemFields::CART_ID => $this->{CartItemFields::CART_ID},
            CartItemFields::PRODUCT_ID => $this->{CartItemFields::PRODUCT_ID},
            CartItemFields::QUANTITY => $this->{CartItemFields::QUANTITY},
        ];
    }
}
