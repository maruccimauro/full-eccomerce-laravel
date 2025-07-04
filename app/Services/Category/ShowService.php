<?php

namespace App\Services\Category;

use App\Models\Category;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class ShowService
{
  public function execute($category_id)
  {
    $category = Category::find($category_id);
    if (!$category) {
      throw new HttpResponseException(response()->json(['message' => "No se ha encontrado la categoria con [$category_id]"], Response::HTTP_NOT_FOUND));
    }

    if (!Gate::allows('view', $category)) {
      throw new HttpResponseException(response()->json(['message' => 'No tienes autorizacion para realizar esta accion.'], Response::HTTP_FORBIDDEN));
    }

    return $category;
  }
}
