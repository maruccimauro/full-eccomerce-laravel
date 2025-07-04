<?php

namespace App\DTOs\Address;

use Illuminate\Http\Request;
use App\Fields\AddressFields;
use App\DTOs\BaseDTO;

class StoreDTO
{
  use BaseDTO;
  public function __construct(
    public readonly int $user_id,
    public readonly string $recipient_name,
    public readonly string $line1,
    public readonly ?string $line2,
    public readonly string $city,
    public readonly string $province,
    public readonly string $postal_code,
    public readonly string $country,
    public readonly ?string $phone,
  ) {}

  public static function fromRequest(Request $request): self
  {

    return new self(
      user_id: (int) $request->input(AddressFields::USER_ID),
      recipient_name: $request->input(AddressFields::RECIPIENT_NAME),
      line1: $request->input(AddressFields::LINE1),
      line2: $request->input(AddressFields::LINE2),
      city: $request->input(AddressFields::CITY),
      province: $request->input(AddressFields::PROVINCE),
      postal_code: $request->input(AddressFields::POSTAL_CODE),
      country: $request->input(AddressFields::COUNTRY),
      phone: $request->input(AddressFields::PHONE),
    );
  }

  public function toArray(): array
  {
    return get_object_vars($this);
  }
}
