<?php

namespace App\Services\CartItem;

use App\Models\CartItem;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;


class ShowService
{
  public function execute($cartItem_id)
  {
    $id = $cartItem_id;
    $cartItem = CartItem::find($id);

    if (!$cartItem) {
      throw new HttpResponseException(response()->json(['message' => 'El id del carrito ingresado no es valido.'], Response::HTTP_NOT_FOUND));
    }

    if (!Gate::allows('view', $cartItem)) {
      throw new HttpResponseException(response()->json(['message' => 'No tienes autorizacion para realizar esta accion.'], Response::HTTP_FORBIDDEN));
    }

    return $cartItem;
  }
}
