<?php

namespace App\Services\Order;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Order;

class ShowWithOrderItemsService
{
  public function execute($order_id)
  {

    $order = Order::with('orderItems')->find($order_id);

    if (!$order) {
      throw new HttpResponseException(response()->json(['message' => 'El id de la orden ingresada no es valido.'], Response::HTTP_NOT_FOUND));
    }

    if (!Gate::allows('ShowWithOrderItems', $order)) {
      throw new HttpResponseException(response()->json(['message' => 'No tienes autorizacion para realizar esta accion.'], Response::HTTP_FORBIDDEN));
    }

    return $order;
  }
}
