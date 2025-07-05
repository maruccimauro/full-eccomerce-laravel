<?php

namespace App\Services\ProductImage;

use App\Models\ProductImage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;


class DestroyService
{

  public function execute($productImage_id)
  {

    $id = $productImage_id;
    $productImage = ProductImage::find($id);

    if (!$productImage) {
      throw new HttpResponseException(response()->json(['Message' => "No se ha encontrado ninguna imagen de producto con el id [$id]"], Response::HTTP_NOT_FOUND));
    }

    if (!Gate::allows('delete', $productImage)) {
      throw new HttpResponseException(response()->json(['message' => 'No tienes autorizacion para realizar esta accion.'], Response::HTTP_FORBIDDEN));
    }

    if (!$productImage->delete()) {
      throw new HttpResponseException(response()->json(['message' => "Hubo un error al intentar eliminar la categoria [$id]"], Response::HTTP_INTERNAL_SERVER_ERROR));
    }
  }
}
