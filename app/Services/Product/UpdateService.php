<?php

namespace App\Services\Product;

use App\DTOs\Product\UpdateDTO;
use App\Fields\ProductFields;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;
use App\Models\Product;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Category;
use App\Fields\CategoryFields;

class UpdateService
{
  public function execute(UpdateDTO $dto)
  {

    $id = $dto->{ProductFields::ID};
    $name = Str::title($dto->{ProductFields::NAME});
    $slug = Str::slug($name);
    $category_id = $dto->{ProductFields::CATEGORY_ID};

    $product = Product::find($id);
    if (!$product) {
      throw new HttpResponseException(response()->json(['Message' => "No se ha encontrado ningun producto con el id [$id]"], Response::HTTP_NOT_FOUND));
    }

    if (!Gate::allows('create', Product::class)) {
      throw new HttpResponseException(response()->json(['message' => 'No tienes autorizacion para realizar esta accion.'], Response::HTTP_FORBIDDEN));
    }

    if (
      Product::where(ProductFields::NAME, $name)
      ->where(ProductFields::ID, "!=", $id)
      ->exists()
    ) {
      throw new HttpResponseException(response()->json(['message' => 'El producto ingresado ya existe.'], Response::HTTP_UNPROCESSABLE_ENTITY));
    }

    if (!Category::where(CategoryFields::ID, $category_id)->exists()) {
      throw new HttpResponseException(response()->json(['message' => "La categoria ingresada no existe."], Response::HTTP_NOT_FOUND));
    }

    $product->update([
      ProductFields::NAME => $name,
      ProductFields::SLUG => $slug,
      ProductFields::DESCRIPTION => $dto->{ProductFields::DESCRIPTION},
      ProductFields::PRICE => $dto->{ProductFields::PRICE},
      ProductFields::STOCK => $dto->{ProductFields::STOCK},
      ProductFields::CATEGORY_ID => $dto->{ProductFields::CATEGORY_ID},
      ProductFields::IS_ACTIVE => $dto->{ProductFields::IS_ACTIVE},
    ]);

    return $product;
  }
}
