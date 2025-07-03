<?php

namespace App\Http\Resources\Address;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Enums\AddressEnum;

class AddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            AddressEnum::ID => $this->{AddressEnum::ID},
            AddressEnum::USER_ID => $this->{AddressEnum::USER_ID},
            AddressEnum::RECIPIENT_NAME => $this->{AddressEnum::RECIPIENT_NAME},
            AddressEnum::LINE1 => $this->{AddressEnum::LINE1},
            AddressEnum::LINE2 => $this->{AddressEnum::LINE2},
            AddressEnum::CITY => $this->{AddressEnum::CITY},
            AddressEnum::PROVINCE => $this->{AddressEnum::PROVINCE},
            AddressEnum::POSTAL_CODE => $this->{AddressEnum::POSTAL_CODE},
            AddressEnum::COUNTRY => $this->{AddressEnum::COUNTRY},
            AddressEnum::PHONE => $this->{AddressEnum::PHONE},
        ];
    }
}
