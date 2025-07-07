<?php

namespace App\Services\CartItem;

use App\Models\CartItem;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;


class DestroyService
{
  public function execute($carItem_id)
  {

    $cartItem = CartItem::find($carItem_id);

    if (!$cartItem) {
      throw new HttpResponseException(response()->json(['message' => 'El id del carrito ingresado no es valido.'], Response::HTTP_NOT_FOUND));
    }

    if (!Gate::allows('delete', $cartItem)) {
      throw new HttpResponseException(response()->json(['message' => 'No tienes autorizacion para realizar esta accion.'], Response::HTTP_FORBIDDEN));
    }

    if (!$cartItem->delete()) {
      throw new HttpResponseException(response()->json(['message' => 'Hubo un error al intentar eliminar el item del carrito.'], Response::HTTP_INTERNAL_SERVER_ERROR));
    }
  }
}
