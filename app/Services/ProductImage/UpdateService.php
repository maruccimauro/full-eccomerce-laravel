<?php

namespace App\Services\ProductImage;

use App\DTOs\ProductImage\UpdateDTO;
use App\Fields\ProductFields;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Gate;
use App\Models\ProductImage;
use App\Fields\ProductImageFields;
use App\Models\Product;

class UpdateService
{
  public function execute(UpdateDTO $dto, $productImage_id)
  {
    $id = $productImage_id;
    $product_id = $dto->{ProductImageFields::PRODUCT_ID};
    $productImage = ProductImage::find($id);
    $is_main = $dto->{ProductImageFields::IS_MAIN};
    if (!$productImage) {
      throw new HttpResponseException(response()->json(['Message' => "No se ha encontrado ninguna imagen de producto con el id [$id]"], Response::HTTP_NOT_FOUND));
    }

    if (!Gate::allows('update', $productImage)) {
      throw new HttpResponseException(response()->json(['message' => 'No tienes autorizacion para realizar esta accion.'], Response::HTTP_FORBIDDEN));
    }

    if (!Product::where(ProductFields::ID, $product_id)->exists()) {
      throw new HttpResponseException(response()->json(['message' => 'El id del producto no es valido.', Response::HTTP_NOT_FOUND]));
    }

    // evitamos que hayan dos imagenes main
    if ($is_main) {
      if (
        ProductImage::where(ProductImageFields::PRODUCT_ID, $product_id)
        ->where(ProductImageFields::ID, '!=', $id)
        ->exists()
      ) {
        throw new HttpResponseException(response()->json(['message' => 'El producto ya contiene una imagen principal'], Response::HTTP_UNPROCESSABLE_ENTITY));
      };
    }

    $productImage->update($dto->toArray());
    return $productImage;
  }
}
