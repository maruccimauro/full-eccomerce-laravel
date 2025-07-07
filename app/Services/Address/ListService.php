<?php

namespace App\Services\Address;

use Illuminate\Support\Facades\Auth;
use App\Models\Address;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ListService
{
  public function execute()
  {
    if (Gate::denies('viewAny', [Address::class])) {
      throw new HttpResponseException(response()->json(['message' => 'No tienes autorizacion para realizar esta accion.'], Response::HTTP_FORBIDDEN));
    }
    $addresses = Auth::user()->addresses()->get();
    return $addresses;
  }
}
