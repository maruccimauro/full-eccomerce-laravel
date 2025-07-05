<?php

namespace App\Services\ProductImage;

use App\DTOs\ProductImage\StoreDTO;
use App\Fields\ProductFields;
use App\Fields\ProductImageFields;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Gate;

class StoreService
{
  public function execute(StoreDTO $dto)
  {

    $product_id = $dto->{ProductImageFields::PRODUCT_ID};
    $is_main = $dto->{ProductImageFields::IS_MAIN};
    if (!Gate::allows('create', ProductImage::class)) {
      throw new HttpResponseException(response()->json(['message' => 'No tienes autorizacion para realizar esta accion.'], Response::HTTP_FORBIDDEN));
    }

    $product_id = $dto->{ProductImageFields::PRODUCT_ID};

    if (!Product::where(ProductFields::ID, $product_id)->exists()) {
      throw new HttpResponseException(response()->json(['message' => 'El id del producto no es valido.', Response::HTTP_NOT_FOUND]));
    }

    // evitamos que hayan dos imagenes main
    if ($is_main) {
      if (ProductImage::where(ProductImageFields::PRODUCT_ID, $product_id)->exists()) {
        throw new HttpResponseException(response()->json(['message' => 'El producto ya contiene una imagen principal'], Response::HTTP_UNPROCESSABLE_ENTITY));
      };
    }

    $productImage = ProductImage::create($dto->toArray());
    return $productImage;
  }
}
