<?php

namespace App\Services\ProductImage;

use App\Models\ProductImage;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ListService
{
  public function execute()
  {

    if (!Gate::allows('viewAny', ProductImage::class)) {
      throw new HttpResponseException(response()->json(['message' => 'No tienes autorizacion para realizar esta accion.'], Response::HTTP_FORBIDDEN));
    }
    return ProductImage::all();
  }
}
