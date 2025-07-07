<?php

namespace App\Services\Address;

use App\DTOs\Address\StoreDTO;
use App\Fields\AddressFields;
use App\Models\Address;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class StoreService
{
  public function execute(StoreDTO $dto)
  {
    $line1 = $dto->{AddressFields::LINE1};
    $line2 = $dto->{AddressFields::LINE2};
    $postal_code = $dto->{AddressFields::POSTAL_CODE};
    $addresses = Auth::user()->addresses();


    if (Gate::denies('create', Address::class)) {
      throw new HttpResponseException(response()->json(['message' => 'No tienes autorizacion para realizar esta accion.'], Response::HTTP_FORBIDDEN));
    }

    if ($addresses->count() >= 3) {
      throw new HttpResponseException(response()->json(['message' => 'Solo puedes tener un maximo de 3 direcciones al mismo tiempo.'], Response::HTTP_UNPROCESSABLE_ENTITY));
    }

    $duplicate = $addresses
      ->where(AddressFields::LINE1, $line1)
      ->where(AddressFields::LINE2, $line2)
      ->where(AddressFields::POSTAL_CODE, $postal_code)
      ->exists();

    if ($duplicate) {
      throw new HttpResponseException(response()->json(['message' => 'Esta dirección ya fue registrada anteriormente.'], Response::HTTP_CONFLICT));
    }

    $address = $addresses->create($dto->toArray());
    return $address;
  }
}
