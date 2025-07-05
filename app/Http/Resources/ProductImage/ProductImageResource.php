<?php

namespace App\Http\Resources\ProductImage;

use App\Fields\ProductImageFields;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductImageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            ProductImageFields::ID => $this->{ProductImageFields::ID},
            ProductImageFields::PRODUCT_ID => $this->{ProductImageFields::PRODUCT_ID},
            ProductImageFields::URL => $this->{ProductImageFields::URL},
            ProductImageFields::IS_MAIN => $this->{ProductImageFields::IS_MAIN},
        ];
    }
}
