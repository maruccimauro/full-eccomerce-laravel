<?php

namespace App\Http\Resources\Order;

use App\Fields\OrderFields;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            OrderFields::ID => $this->{OrderFields::ID},
            OrderFields::USER_ID => $this->{OrderFields::USER_ID},
            OrderFields::ADDRESS_ID => $this->{OrderFields::ADDRESS_ID},
            OrderFields::TOTAL => $this->{OrderFields::TOTAL},
            OrderFields::STATUS => $this->{OrderFields::STATUS},
            OrderFields::PAYMENT_METHOD => $this->{OrderFields::PAYMENT_METHOD},
            OrderFields::PAYMENT_STATUS => $this->{OrderFields::PAYMENT_STATUS},
        ];
    }
}
