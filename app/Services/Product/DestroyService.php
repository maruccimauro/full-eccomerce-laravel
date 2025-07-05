<?php

namespace App\Services\Product;

use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Product;
use Illuminate\Support\Facades\Gate;

class DestroyService
{
  public function execute($product_id)
  {

    $product = Product::find($product_id);
    if (!$product) {
      throw new HttpResponseException(response()->json(['Message' => "No se ha encontrado ningun producto con el id [$product_id]"], Response::HTTP_NOT_FOUND));
    }

    if (!Gate::allows('delete', $product)) {
      throw new HttpResponseException(response()->json(['message' => 'No tienes autorizacion para realizar esta accion.'], Response::HTTP_FORBIDDEN));
    }

    if (!$product->delete()) {
      throw new HttpResponseException(response()->json(['message' => "Hubo un error al intentar eliminar la categoria [$product_id]"], Response::HTTP_INTERNAL_SERVER_ERROR));
    }
  }
}
