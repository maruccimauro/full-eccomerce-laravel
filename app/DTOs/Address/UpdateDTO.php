<?php

namespace App\DTOs\Address;

use Illuminate\Http\Request;
use App\Enums\AddressEnum;
use App\DTOs\BaseDTO;

class UpdateDTO
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
      user_id: (int) $request->input(AddressEnum::USER_ID),
      recipient_name: $request->input(AddressEnum::RECIPIENT_NAME),
      line1: $request->input(AddressEnum::LINE1),
      line2: $request->input(AddressEnum::LINE2),
      city: $request->input(AddressEnum::CITY),
      province: $request->input(AddressEnum::PROVINCE),
      postal_code: $request->input(AddressEnum::POSTAL_CODE),
      country: $request->input(AddressEnum::COUNTRY),
      phone: $request->input(AddressEnum::PHONE),
    );
  }
}
