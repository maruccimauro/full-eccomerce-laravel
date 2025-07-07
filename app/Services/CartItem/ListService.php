<?php

namespace App\Services\CartItem;

use App\Models\CartItem;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;


class ListService
{
  public function execute()
  {
    if (!Gate::allows('viewAny', CartItem::class)) {
      throw new HttpResponseException(response()->json(['message' => 'No tienes autorizacion para realizar esta accion.'], Response::HTTP_FORBIDDEN));
    }

    $cartItems = CartItem::all();
    return $cartItems;
  }
}
