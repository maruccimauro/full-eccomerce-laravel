<?php

namespace App\DTOs\Address;

use Illuminate\Http\Request;

class UpdateDTO
{

  public readonly int $user_id;
  public readonly string $recipient_name;
  public readonly string $line1;
  public readonly ?string $line2;
  public readonly string $city;
  public readonly string $province;
  public readonly string $postal_code;
  public readonly string $country;
  public readonly ?string $phone;

  public function __construct(
    int $user_id,
    string $recipient_name,
    string $line1,
    ?string $line2,
    string $city,
    string $province,
    string $postal_code,
    string $country,
    ?string $phone
  ) {
    $this->user_id = $user_id;
    $this->recipient_name = $recipient_name;
    $this->line1 = $line1;
    $this->line2 = $line2;
    $this->city = $city;
    $this->province = $province;
    $this->postal_code = $postal_code;
    $this->country = $country;
    $this->phone = $phone;
  }

  public static function fromRequest(Request $request): self
  {
    return new self(
      user_id: (int) $request->input('user_id'),
      recipient_name: $request->input('recipient_name'),
      line1: $request->input('line1'),
      line2: $request->input('line2'),
      city: $request->input('city'),
      province: $request->input('province'),
      postal_code: $request->input('postal_code'),
      country: $request->input('country'),
      phone: $request->input('phone')
    );
  }

  public function toArray(): array
  {
    return get_object_vars($this);
  }
}
