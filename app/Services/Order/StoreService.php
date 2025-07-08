<?php

namespace App\Services\Order;

use App\DTOs\Order\StoreDTO;
use App\Enums\OrderPaymentStatusEnum;
use App\Enums\OrderStatusEnum;
use App\Fields\AddressFields;
use App\Fields\CartItemFields;
use App\Fields\OrderFields;
use App\Fields\OrderItemFields;
use App\Fields\ProductFields;
use App\Fields\UserFields;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StoreService
{

  public function execute(StoreDTO $dto)
  {
    $user = Auth::user();
    $addresses = $user->addresses;
    $address_id = $dto->{OrderFields::ADDRESS_ID};
    $cart = $user->cart;
    $cartItems = $cart->cartItems;

    if (!Gate::allows('create', Order::class)) {
      throw new HttpResponseException(response()->json(['message' => 'No tienes autorizacion para realizar esta accion.'], Response::HTTP_FORBIDDEN));
    }

    if (!$cart) {
      throw new HttpResponseException(response()->json(['message' => 'El usuario no posee ningun carrito.'], Response::HTTP_NOT_FOUND));
    }

    if ($cartItems->isEmpty()) {
      throw new HttpResponseException(response()->json(['message' => 'No existen items en el carrito para poder generar una orden.'], Response::HTTP_UNPROCESSABLE_ENTITY));
    }

    $address = $addresses->firstwhere(AddressFields::ID, $address_id);
    if (!$address || $address->{AddressFields::USER_ID} !== $user->{UserFields::ID}) {
      throw new HttpResponseException(response()->json(['message' => 'No se ha encontrado la direccion relacionada con el usuario.'], Response::HTTP_NOT_FOUND));
    }


    return DB::transaction(function () use ($user, $cartItems, $address_id, $dto, $cart) {

      $total = $cartItems->sum(function ($item) {
        $price = Product::where(ProductFields::ID, $item->{CartItemFields::PRODUCT_ID})
          ->value(ProductFields::PRICE) ?? 0;
        return $item->{CartItemFields::QUANTITY} * $price;
      });

      $order = Order::create([
        OrderFields::USER_ID => $user->{UserFields::ID},
        OrderFields::ADDRESS_ID => $address_id,
        OrderFields::TOTAL => $total,
        OrderFields::STATUS => OrderStatusEnum::default(),
        OrderFields::PAYMENT_METHOD => $dto->{OrderFields::PAYMENT_METHOD},
        OrderFields::PAYMENT_STATUS => OrderPaymentStatusEnum::default(),
      ]);

      foreach ($cartItems as $cartItem) {
        $product_id = $cartItem->{CartItemFields::PRODUCT_ID};
        $quantity = $cartItem->{CartItemFields::QUANTITY};
        $unit_price = Product::where(ProductFields::ID, $product_id)
          ->value(ProductFields::PRICE) ?? 0;

        OrderItem::create([
          OrderItemFields::ORDER_ID => $order->id,
          OrderItemFields::PRODUCT_ID => $product_id,
          OrderItemFields::QUANTITY => $quantity,
          OrderItemFields::UNIT_PRICE => $unit_price,
          OrderItemFields::TOTAL_PRICE => $unit_price * $quantity,
        ]);
      }

      $cart->cartItems()->delete();

      return $order;
    });

    return $result;
  }
}
