<?php

namespace App\Services\Product;

use App\DTOs\Product\StoreDTO;
use App\Fields\CategoryFields;
use App\Fields\ProductFields;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;



class StoreService
{

  public function execute(StoreDTO $dto)
  {
    $name = Str::title($dto->{ProductFields::NAME});
    $slug = Str::slug($name);
    $category_id = $dto->{ProductFields::CATEGORY_ID};

    if (!Gate::allows('create', Product::class)) {
      throw new HttpResponseException(response()->json(['message' => 'No tienes autorizacion para realizar esta accion.'], Response::HTTP_FORBIDDEN));
    }

    if (Product::where(ProductFields::NAME, $name)->exists()) {
      throw new HttpResponseException(response()->json(['message' => 'El producto ingresado ya existe.'], Response::HTTP_UNPROCESSABLE_ENTITY));
    }

    if (!Category::where(CategoryFields::ID, $category_id)->exists()) {
      throw new HttpResponseException(response()->json(['message' => "La categoria ingresada no existe."], Response::HTTP_NOT_FOUND));
    }

    return Product::create([
      ProductFields::NAME => $name,
      ProductFields::SLUG => $slug,
      ProductFields::DESCRIPTION => $dto->{ProductFields::DESCRIPTION},
      ProductFields::PRICE => $dto->{ProductFields::PRICE},
      ProductFields::STOCK => $dto->{ProductFields::STOCK},
      ProductFields::CATEGORY_ID => $dto->{ProductFields::CATEGORY_ID},
      ProductFields::IS_ACTIVE => $dto->{ProductFields::IS_ACTIVE},
    ]);
  }
}
