<?php

namespace App\Services\Cart;

use App\Models\Cart;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ListService
{
  public function execute()
  {

    if (!Gate::allows('viewany', Cart::class)) {
      throw new HttpResponseException(response()->json(['message' => 'No tienes autorizacion para realizar esta accion.'], Response::HTTP_FORBIDDEN));
    }

    return Auth::user()->cart()->get();
  }
}
