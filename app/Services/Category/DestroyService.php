<?php

namespace App\Services\Category;

use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Category;


class DestroyService
{
  public function execute($category_id)
  {

    $category = Category::find($category_id);
    if (!$category) {
      throw new HttpResponseException(response()->json(['message' => "No existe ninguna categoria con el id [$category_id]"], Response::HTTP_NOT_FOUND));
    }
    if (!Gate::allows('delete', $category)) {
      throw new HttpResponseException(response()->json(['message' => 'No tienes autorizacion para realizar esta accion.'], Response::HTTP_FORBIDDEN));
    }

    if (!$category->delete()) {
      throw new HttpResponseException(response()->json(['message' => "Hubo un error al intentar eliminar la categoria [$category_id]"], Response::HTTP_INTERNAL_SERVER_ERROR));
    }
  }
}
