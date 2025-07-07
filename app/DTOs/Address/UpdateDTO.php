<?php

namespace App\DTOs\Address;

use Illuminate\Http\Request;
use App\Fields\AddressFields;
use App\DTOs\BaseDTO;

class UpdateDTO
{
  use BaseDTO;

  public function __construct(
    public readonly string $recipient_name,
    public readonly string $line1,
    public readonly ?string $line2, // Line2 can be nullable
    public readonly string $city,
    public readonly string $province,
    public readonly string $postal_code,
    public readonly string $country,
    public readonly string $phone,
  ) {}

  public static function fromRequest(Request $request): self
  {
    return new self(
      $request->{AddressFields::RECIPIENT_NAME},
      $request->{AddressFields::LINE1},
      $request->{AddressFields::LINE2},
      $request->{AddressFields::CITY},
      $request->{AddressFields::PROVINCE},
      $request->{AddressFields::POSTAL_CODE},
      $request->{AddressFields::COUNTRY},
      $request->{AddressFields::PHONE}
    );
  }
}
