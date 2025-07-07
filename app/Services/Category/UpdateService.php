<?php

namespace App\Services\Category;

use App\DTOs\Category\UpdateDTO;
use App\Fields\CategoryFields;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Category;
use Illuminate\Support\Str;

class UpdateService
{
  public function execute(UpdateDTO $dto, $category_id)
  {
    $id = $category_id;
    $name = Str::title($dto->{CategoryFields::NAME});
    $slug = Str::slug($name);
    $parent_id = $dto->{CategoryFields::PARENT_ID};

    // Buscamos la categoría que se quiere actualizar
    $category = Category::find($id);
    if (!$category) {
      throw new HttpResponseException(
        response()->json(['message' => "No se encontró la categoría con ID [$id]"], Response::HTTP_NOT_FOUND)
      );
    }

    //pedimos permiso de politicas
    if (!Gate::allows('update', $category)) {
      throw new HttpResponseException(response()->json(['message' => 'No tienes autorizacion para realizar esta accion.'], Response::HTTP_FORBIDDEN));
    }

    // Previene la creación de categorías raíz (sin padre) con nombres duplicados.
    if ($parent_id === Null) {
      if (
        Category::where(CategoryFields::NAME, $name)
        ->where(CategoryFields::ID, '!=', $id)
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
        ->where(CategoryFields::ID, '!=', $id)
        ->exists()
      ) {
        throw new HttpResponseException(response()->json(['message' => 'La categoria ya existe en la misma categoria superior.'], Response::HTTP_UNPROCESSABLE_ENTITY));
      }
    }

    $category->update([
      CategoryFields::NAME => $name,
      CategoryFields::SLUG => $slug,
      CategoryFields::PARENT_ID => $parent_id
    ]);

    return $category;
  }
}
