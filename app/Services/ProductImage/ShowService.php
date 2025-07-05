<?php

namespace App\Services\ProductImage;

use App\Models\ProductImage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class ShowService
{
  public function execute($productImage_id)
  {
    $productImage = ProductImage::find($productImage_id);

    if (!$productImage) {
      throw new HttpResponseException(response()->json(['Message' => "No se ha encontrado ninguna imagen con el id [$productImage_id]"], Response::HTTP_NOT_FOUND));
    }

    if (!Gate::allows('view', $productImage)) {
      throw new HttpResponseException(response()->json(['message' => 'No tienes autorizacion para realizar esta accion.'], Response::HTTP_FORBIDDEN));
    }

    return $productImage;
  }
}
