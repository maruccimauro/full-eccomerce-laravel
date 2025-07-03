<?php

namespace App\Services\Address;

use App\Models\Address;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class DestroyService
{
  public function execute(int $address_id)
  {
    $address = Address::find($address_id);

    if (!$address) {
      throw new HttpResponseException(response()->json(['message' => "No existe ninguna direccion con el id [$address_id]"], Response::HTTP_NOT_FOUND));
    }

    if (Gate::denies('delete', [Address::class, $address])) {
      throw new HttpResponseException(response()->json(['message' => 'No tienes autorizacion para realizar esta accion.'], Response::HTTP_FORBIDDEN));
    }

    if (!$address->delete()) {
      throw new HttpResponseException(response()->json(['message' => 'Hubo un error al intentar eliminar la direccion.'], Response::HTTP_INTERNAL_SERVER_ERROR));
    }
  }
}
