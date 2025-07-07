<?php

namespace App\Services\CartItem;

use App\DTOs\CartItem\StoreDTO;;

use App\Fields\CartItemFields;
use App\Fields\ProductFields;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class StoreService
{
  public function execute(StoreDTO $dto)
  {
    $cart = User::find(1)->cart()->first();
    $product_id = $dto->{CartItemFields::PRODUCT_ID};
    $quantity = $dto->{CartItemFields::QUANTITY};


    if (!Gate::allows('create', CartItem::class)) {
      throw new HttpResponseException(response()->json(['message' => 'No tienes autorizacion para realizar esta accion.'], Response::HTTP_FORBIDDEN));
    }

    if (!$cart) {
      throw new HttpResponseException(response()->json(['message' => 'No posees ningun carrito'], Response::HTTP_NOT_FOUND));
    }

    if (!Product::where(ProductFields::ID, $product_id)->exists()) {
      throw new HttpResponseException(response()->json(['message' => 'El id del product ingresado no es valido.'], Response::HTTP_NOT_FOUND));
    }

    if ($quantity < 1) {
      throw new HttpResponseException(response()->json(['message' => 'La cantidad ingresada no es valida'], Response::HTTP_UNPROCESSABLE_ENTITY));
    }

    $cartItem = $cart->cartItems()->create($dto->toArray());
    return $cartItem;
  }
}
