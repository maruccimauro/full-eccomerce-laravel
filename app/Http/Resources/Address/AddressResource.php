<?php

namespace App\Http\Resources\Address;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Fields\AddressFields;

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
            AddressFields::ID => $this->{AddressFields::ID},
            AddressFields::USER_ID => $this->{AddressFields::USER_ID},
            AddressFields::RECIPIENT_NAME => $this->{AddressFields::RECIPIENT_NAME},
            AddressFields::LINE1 => $this->{AddressFields::LINE1},
            AddressFields::LINE2 => $this->{AddressFields::LINE2},
            AddressFields::CITY => $this->{AddressFields::CITY},
            AddressFields::PROVINCE => $this->{AddressFields::PROVINCE},
            AddressFields::POSTAL_CODE => $this->{AddressFields::POSTAL_CODE},
            AddressFields::COUNTRY => $this->{AddressFields::COUNTRY},
            AddressFields::PHONE => $this->{AddressFields::PHONE},
        ];
    }
}
