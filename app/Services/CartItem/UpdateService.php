<?php

namespace App\Services\CartItem;

use App\DTOs\CartItem\UpdateDTO;
use App\Fields\CartFields;
use App\Fields\CartItemFields;
use App\Fields\ProductFields;
use App\Models\CartItem;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;


class UpdateService
{
  public function execute(UpdateDTO $dto, $cartitem_id)
  {
    $id = $cartitem_id;
    $product_id = $dto->{CartItemFields::PRODUCT_ID};
    $quantity = $dto->{CartItemFields::QUANTITY};

    $cartItem = CartItem::find($id);

    if (!$cartItem) {
      throw new HttpResponseException(response()->json(['message' => 'El id del carrito ingresado no es valido.'], Response::HTTP_NOT_FOUND));
    }

    if (!Gate::allows('update', $cartItem)) {
      throw new HttpResponseException(response()->json(['message' => 'No tienes autorizacion para realizar esta accion.'], Response::HTTP_FORBIDDEN));
    }

    if (!Product::where(ProductFields::ID, $product_id)->exists()) {
      throw new HttpResponseException(response()->json(['message' => 'El id del product ingresado no es valido.'], Response::HTTP_NOT_FOUND));
    }

    if ($quantity < 1) {
      throw new HttpResponseException(response()->json(['message' => 'La cantidad ingresada no es valida'], Response::HTTP_UNPROCESSABLE_ENTITY));
    }

    $cartItem->update($dto->toArray());
    return $cartItem;
  }
}
