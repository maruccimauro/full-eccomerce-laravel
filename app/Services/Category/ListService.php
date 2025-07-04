<?php

namespace App\Services\Category;

use App\Models\Category;
use App\Policies\CategoryPolicy;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class listService
{
  public function execute()
  {
    if (!Gate::allows('viewAny', Category::class)) {
      throw new HttpResponseException(response()->json(['message' => 'No tienes autorizacion para realizar esta accion.'], Response::HTTP_FORBIDDEN));
    }

    return Category::all();
  }
}
