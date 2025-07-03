<?php

namespace App\Services\Address;

use Illuminate\Support\Facades\Auth;
use App\Models\Address;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ShowService
{
  public function execute($address_id)
  {

    $address = Address::where('id', $address_id)->first();

    if (!$address) {
      throw new HttpResponseException(response()->json(['message' => "No existe ninguna direccion con el id [$address_id]"], Response::HTTP_NOT_FOUND));
    }

    if (Gate::denies('view', [Address::class, $address])) {
      throw new HttpResponseException(response()->json(['message' => 'No tienes autorizacion para realizar esta accion.'], Response::HTTP_FORBIDDEN));
    }

    return $address;
  }
}
