<?php

namespace App\Http\Resources;

use App\Fields\ProductFields;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            ProductFields::ID => $this->{ProductFields::ID},
            ProductFields::NAME => $this->{ProductFields::NAME},
            ProductFields::SLUG => $this->{ProductFields::SLUG},
            ProductFields::DESCRIPTION => $this->{ProductFields::DESCRIPTION},
            ProductFields::PRICE => $this->{ProductFields::PRICE},
            ProductFields::STOCK => $this->{ProductFields::STOCK},
            ProductFields::CATEGORY_ID => $this->{ProductFields::CATEGORY_ID},
            ProductFields::IS_ACTIVE => $this->{ProductFields::IS_ACTIVE},
        ];
    }
}
