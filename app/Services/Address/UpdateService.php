<?php

namespace App\Services\Address;


use App\DTOs\Address\UpdateDTO;
use Illuminate\Support\Facades\Auth;
use App\Models\Address;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class UpdateService
{
  public function execute(UpdateDTO $dto, int $address_id)
  {
    $address = Address::find($address_id);

    if (!$address) {
      throw new HttpResponseException(response()->json(['message' => "No existe ninguna direccion con el id [$address_id]"], Response::HTTP_NOT_FOUND));
    }

    if (Gate::denies('update', [Address::class, $address])) {
      throw new HttpResponseException(response()->json(['message' => 'No tienes autorizacion para realizar esta accion.'], Response::HTTP_FORBIDDEN));
    }

    $duplicate = Address::where('user_id', Auth::id())
      ->where('line1', $dto->line1)
      ->where('postal_code', $dto->postal_code)
      ->where('id', '!=', $address_id)
      ->exists();

    if ($duplicate) {
      throw new HttpResponseException(response()->json(['message' => 'Esta dirección ya fue registrada anteriormente.'], Response::HTTP_CONFLICT));
    }

    $address->fill($dto->toArray());
    $address->save();

    return $address;
  }
}
