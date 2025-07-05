<?php

namespace App\Services\Product;

use App\Models\Product;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ShowService
{
  public function execute($product_id)
  {
    $product = Product::find($product_id);
    if (!$product) {
      throw new HttpResponseException(response()->json(['Message' => "No se ha encontrado ningun producto con el id [$product_id]"], Response::HTTP_NOT_FOUND));
    }

    if (!Gate::allows('view', $product)) {
      throw new HttpResponseException(response()->json(['message' => 'No tienes autorizacion para realizar esta accion.'], Response::HTTP_FORBIDDEN));
    }

    return $product;
  }
}
