<?php

namespace App\Services\Cart;

use App\DTOs\Cart\StoreDTO;
use App\Fields\CartFields;
use App\Models\Cart;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;


class StoreService
{
  public function execute(StoreDTO $dto)
  {
    $user_id = $dto->{CartFields::USER_ID};
    if (!Gate::allows('create', Cart::class)) {
      throw new HttpResponseException(response()->json(['message' => 'No tienes autorizacion para realizar esta accion.'], Response::HTTP_FORBIDDEN));
    }

    if (Cart::where(CartFields::USER_ID, $user_id)->exists()) {
      throw new HttpResponseException(response()->json(['message' => 'El usaurio ya tiene un carrito exitente.'], Response::HTTP_FORBIDDEN));
    }

    $cart = Cart::create($dto->toArray());
    return $cart;
  }
}
