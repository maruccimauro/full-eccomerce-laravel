<?php

namespace App\Services\Cart;

use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Cart;
use Illuminate\Support\Facades\Gate;

class ShowService
{
  public function execute($cart_id)
  {

    $cart = Cart::find($cart_id);
    if (!$cart) {
      throw new HttpResponseException(response()->json(['message' => "No se ha encontrado el carrito con id [$cart_id]"], Response::HTTP_NOT_FOUND));
    }

    if (!Gate::allows('view', $cart)) {
      throw new HttpResponseException(response()->json(['message' => 'No tienes autorizacion para realizar esta accion.'], Response::HTTP_FORBIDDEN));
    }

    return $cart;
  }
}
