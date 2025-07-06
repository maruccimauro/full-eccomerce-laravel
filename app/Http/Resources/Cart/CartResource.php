<?php

namespace App\Http\Resources\Cart;

use App\Fields\CartFields;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            CartFields::ID => $this->{CartFields::ID},
            CartFields::USER_ID => $this->{CartFields::USER_ID}
        ];
    }
}
