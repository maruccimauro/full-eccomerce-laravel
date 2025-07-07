<?php

namespace App\Services\Cart;

use App\DTOs\Cart\UpdateDTO;
use App\Fields\CartFields;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Gate;
use App\Models\Cart;


class UpdateService
{
  public function execute(UpdateDTO $dto, $cart_id)
  {
    $id = $cart_id;
    $cart = Cart::find($id);


    if (!$cart) {
      throw new HttpResponseException(response()->json(['message' => "No se ha encontrado el carrito con el id [$cart_id]"], Response::HTTP_NOT_FOUND));
    }

    if (!Gate::allows('update', $cart)) {
      throw new HttpResponseException(response()->json(['message' => 'No tienes autorizacion para realizar esta accion.'], Response::HTTP_FORBIDDEN));
    }

    return $cart;
  }
}
