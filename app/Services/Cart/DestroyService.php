<?php

namespace App\Services\Cart;

use App\Models\Cart;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Gate;


class DestroyService
{
  public function execute($cart_id)
  {
    $id = $cart_id;
    $cart = Cart::find($id);
    if (!$cart) {
      throw new HttpResponseException(response()->json(['message' => "No se ha encontrado el carrito con el id [$cart_id]"], Response::HTTP_NOT_FOUND));
    }

    if (!Gate::allows('delete', $cart)) {
      throw new HttpResponseException(response()->json(['message' => 'No tienes autorizacion para realizar esta accion.'], Response::HTTP_FORBIDDEN));
    }

    if (!$cart->delete()) {
      throw new HttpResponseException(response()->json(['message' => 'Hubo un error al intentar eliminar el carrito.'], Response::HTTP_INTERNAL_SERVER_ERROR));
    }
  }
}
