<?php

namespace App\Services\Category;

use Illuminate\Support\Str;
use App\Fields\CategoryFields;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreService
{
  public function execute($dto)
  {
    $name = ucwords(strtolower(trim($dto->{CategoryFields::NAME})));
    $slug = Str::slug($name);
    $parent_id = $dto->{CategoryFields::PARENT_ID};

    //pedimos permiso de politicas
    if (!Gate::allows('create', Category::class)) {
      throw new HttpResponseException(response()->json(['message' => 'No tienes autorizacion para realizar esta accion.'], Response::HTTP_FORBIDDEN));
    }

    // Previene la creación de categorías raíz (sin padre) con nombres duplicados.
    if ($parent_id === Null) {
      if (
        Category::where(CategoryFields::NAME, $name)
        ->exists()
      ) {
        throw new HttpResponseException(response()->json(['message' => 'La categoria superior ya existe.'], Response::HTTP_UNPROCESSABLE_ENTITY));
      }
    }

    // Previene la creacion de una categoria hija (con padre) con nombres duplicados.
    if ($parent_id !== NULL) {
      if (
        Category::where(CategoryFields::PARENT_ID, $parent_id)
        ->where(CategoryFields::NAME, $name)
        ->exists()
      ) {
        throw new HttpResponseException(response()->json(['message' => 'La categoria ya existe en la misma categoria superior.'], Response::HTTP_UNPROCESSABLE_ENTITY));
      }
    }

    return Category::create([
      CategoryFields::NAME => $name,
      CategoryFields::SLUG =>  $slug,
      CategoryFields::PARENT_ID => $parent_id,
    ]);
  }
}
