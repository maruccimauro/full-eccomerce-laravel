<?php

namespace App\Http\Resources\Category;

use App\Fields\CategoryFields;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            CategoryFields::ID => $this->{CategoryFields::ID},
            CategoryFields::NAME => $this->{CategoryFields::NAME},
            CategoryFields::SLUG => $this->{CategoryFields::SLUG},
            CategoryFields::PARENT_ID => $this->{CategoryFields::PARENT_ID}
        ];
    }
}
