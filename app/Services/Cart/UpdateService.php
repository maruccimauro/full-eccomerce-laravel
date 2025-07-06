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
    $user_id = $dto->{CartFields::USER_ID};

    if (!$cart) {
      throw new HttpResponseException(response()->json(['message' => "No se ha encontrado el carrito con el id [$cart_id]"], Response::HTTP_NOT_FOUND));
    }

    if (!Gate::allows('update', $cart)) {
      throw new HttpResponseException(response()->json(['message' => 'No tienes autorizacion para realizar esta accion.'], Response::HTTP_FORBIDDEN));
    }

    if (Cart::where(CartFields::USER_ID, $user_id)
      ->where(CartFields::ID, "!=", $id)
      ->exists()
    ) {
      throw new HttpResponseException(response()->json(['message' => 'El usaurio ya tiene un carrito exitente.'], Response::HTTP_FORBIDDEN));
    }

    $cart->update($dto->toArray());
    return $cart;
  }
}
