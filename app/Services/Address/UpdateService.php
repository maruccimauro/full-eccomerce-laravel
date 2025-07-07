<?php

namespace App\Services\Address;


use App\DTOs\Address\UpdateDTO;
use App\Fields\AddressFields;
use Illuminate\Support\Facades\Auth;
use App\Models\Address;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class UpdateService
{
  public function execute(UpdateDTO $dto, int $address_id)
  {
    $id = $address_id;
    $line1 = $dto->{AddressFields::LINE1};
    $line2 = $dto->{AddressFields::LINE2};
    $postal_code = $dto->{AddressFields::POSTAL_CODE};
    $address = Address::find($address_id);
    $addresses = Auth::user()->addresses();

    if (!$address) {
      throw new HttpResponseException(response()->json(['message' => "No existe ninguna direccion con el id [$address_id]"], Response::HTTP_NOT_FOUND));
    }

    if (Gate::denies('update', $address)) {
      throw new HttpResponseException(response()->json(['message' => 'No tienes autorizacion para realizar esta accion.'], Response::HTTP_FORBIDDEN));
    }

    $duplicate = $addresses
      ->where(AddressFields::LINE1, $line1)
      ->where(AddressFields::LINE2, $line2)
      ->where(AddressFields::POSTAL_CODE, $postal_code)
      ->where(AddressFields::ID, '!=', $id)
      ->exists();

    if ($duplicate) {
      throw new HttpResponseException(response()->json(['message' => 'Esta dirección ya fue registrada anteriormente.'], Response::HTTP_CONFLICT));
    }

    $address->update($dto->toArray());

    return $address;
  }
}
